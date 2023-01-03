<?php

declare(strict_types=1);

/*
 * Hivelvet open source platform - https://riadvice.tn/
 *
 * Copyright (c) 2022 RIADVICE SUARL and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * Hivelvet is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with Hivelvet; if not, see <http://www.gnu.org/licenses/>.
 */

namespace Actions\Rooms;

use Actions\Base as BaseAction;
use Actions\RequirePrivilegeTrait;
use Enum\ResponseCode;
use Models\Label;
use Models\Preset;
use Models\Room;
use Models\RoomLabel;
use Models\User;
use Respect\Validation\Validator;
use Validation\DataChecker;

/**
 * Class Add.
 */
class Add extends BaseAction
{
    use RequirePrivilegeTrait;

    /**
     * @param mixed $f3
     * @param mixed $params
     *
     * @throws \JsonException
     */
    public function save($f3, $params): void
    {
        $body = $this->getDecodedBody();

        $form = $body['data'];

        $dataChecker = new DataChecker();
        $userId      = $body['user_id'];
        $dataChecker->verify($form['name'], Validator::notEmpty()->setName('name'));
        $dataChecker->verify($form['shortlink'], Validator::notEmpty()->setName('shortlink'));
        $dataChecker->verify($form['preset'], Validator::notEmpty()->setName('preset'));
        $dataChecker->verify($form['labels'], Validator::notEmpty()->setName('labels'));

        $errorMessage = 'Room could not be added';
        if ($dataChecker->allValid()) {
            $user = new User();
            $user = $user->getById($userId);
            if (!$user->dry()) {
                $preset = new Preset();
                $preset = $preset->findById($form['preset']);
                if (!$preset->dry()) {
                    $checkRoom        = new Room();
                    $room             = new Room();
                    $room->name       = $form['name'];
                    $room->short_link = $form['shortlink'];
                    $room->user_id    = $userId;
                    $room->preset_id  = $form['preset'];
                    $room->labels     = $form['labels'];
                    $room->meeting_id = bin2hex(openssl_random_pseudo_bytes(8));

                    if ($checkRoom->nameExists($room->name, $userId)) {
                        $this->logger->error($errorMessage, ['error' => 'Name already exists']);
                        $this->renderJson(['errors' => ['name' => 'Room Name already exists']], ResponseCode::HTTP_PRECONDITION_FAILED);
                    } elseif ($checkRoom->shortlinkExists($room->short_link)) {
                        $this->logger->error($errorMessage, ['error' => 'Room Link already exists']);
                        $this->renderJson(['errors' => ['short_link' => 'Room link already exists']], ResponseCode::HTTP_PRECONDITION_FAILED);
                    } else {
                        while ($checkRoom->meetingIdExists($room->meeting_id)) {
                            $room->meeting_id = bin2hex(openssl_random_pseudo_bytes(8));
                        }

                        try {
                            $room->save();
                        } catch (\Exception $e) {
                            $this->logger->error($errorMessage, ['error' => $e->getMessage()]);
                            $this->renderJson(['errors' => $e->getMessage()], ResponseCode::HTTP_INTERNAL_SERVER_ERROR);

                            return;
                        }
                        if ($form['labels']) {
                            foreach ($form['labels'] as $label) {
                                $l = new Label();
                                $l = $l->getByColor($label);
                                if (!$l->dry()) {
                                    $room_label           = new RoomLabel();
                                    $room_label->label_id = $l['id'];
                                    $room_label->room_id  = $room->id;

                                    $room_label->save();
                                } else {
                                    $this->logger->error($errorMessage);
                                    $this->renderJson([], ResponseCode::HTTP_NOT_FOUND);

                                    return;
                                }
                            }
                        }
                        $room = $room->getRoomInfos($room->id);

                        $r              = new Room();
                        $room['labels'] = $r->getLabels($room['key']);
                        $this->renderJson(['result' => 'success', 'room' => $room], ResponseCode::HTTP_CREATED);
                    }
                } else {
                    $this->logger->error($errorMessage);
                    $this->renderJson([], ResponseCode::HTTP_NOT_FOUND);
                }
            } else {
                $this->logger->error($errorMessage);
                $this->renderJson([], ResponseCode::HTTP_NOT_FOUND);
            }
        } else {
            $this->renderJson(['errors' => $dataChecker->getErrors()], ResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
