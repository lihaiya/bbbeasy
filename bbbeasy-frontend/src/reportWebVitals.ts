/**
 * BBBEasy open source platform - https://riadvice.tn/
 *
 * Copyright (c) 2022-2023 RIADVICE SUARL and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Affero General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * BBBeasy is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License along
 * with BBBEasy; if not, see <http://www.gnu.org/licenses/>.
 */

import { ReportHandler } from 'web-vitals';

const reportWebVitals = (onPerfEntry?: ReportHandler) => {
    if (typeof onPerfEntry === 'function') {
        import('web-vitals')
            .then((webVitals) => {
                const { getCLS, getFID, getFCP, getLCP, getTTFB } = webVitals;
                [getCLS, getFID, getFCP, getLCP, getTTFB].forEach((metric) => {
                    metric(onPerfEntry);
                });
            })
            .catch((error) => {
                console.error('Error loading web-vitals:', error);
            });
    }
};

export default reportWebVitals;
