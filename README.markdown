视频会议系统,开源视频会议,BigBlueButton,大蓝钮视频会议,私有化部署视频会议,视频呼叫中心,企业云课堂,虚拟教室,大学虚拟教室,WebRTC,Audio,Video！！！

<p align="center">
  <img src="https://github.com/riadvice/bbbeasy/blob/develop/bbbeasy-frontend/public/images/logo_02.png" alt="BBBEasy Logo">
</p>

<p align="center">
<a href="https://github.com/riadvice/bbbeasy" target="__blank"><img alt="GitHub forks" src="https://img.shields.io/github/forks/riadvice/bbbeasy?style=social"></a>
<a href="https://github.com/riadvice/bbbeasy" target="__blank"><img alt="GitHub stars" src="https://img.shields.io/github/stars/riadvice/bbbeasy?style=social"></a>
</p>

# BBBEasy团队与中国区团队联络方式
进行BigBlueButton大蓝钮的实施、部署、定制化开发、集群优化，如对接内部系统、电话系统、视频会议系统，进行logo设置，功能定制等，也支持SaaS云运维服务！！！

![bbbeasy微信号](https://github.com/user-attachments/assets/fba4d97e-5d9d-42d9-bcd8-c07cdbf6dfbe)
# BBBEasy

BBBEasy is an open-source  multipurpose meeting rooms manager for BigBlueButton.

## Features

- Smooth installation experience.

- User friendly UI.

- Manage different configuration presets and assign them to rooms.

- Rooms management.

- Users management.

## Components

The web-application is split in two parts:

- A server API.

- A modern front-end.

## 🪴 Project Activity

![Alt](https://repobeats.axiom.co/api/embed/22737fcd7e97f3c37ff740f195ece60264185796.svg "Repobeats analytics image")

## Development

- To launch the backend in the development mode, follow these steps :

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1- Start a Command Prompt as an **Administrator**.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2- Run `cd /path/to/cloned/project/`.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3- Run `vagrant up && vagrant ssh` and wait until the end of the process.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4- Run `cp /app/bbbeasy-backend/app/config/config-development.sample.ini /app/bbbeasy-backend/app/config/config-development.ini`.

- To launch the frontend in the development mode, follow these steps :

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1- Run `cd /app/bbbeasy-frontend`.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2- Run `cp /app/tools/bbbeasy /app/bbbeasy-frontend/bbbeasy`.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3- Run `sed -i -e 's/\r$//' bbbeasy`.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4- Run `sed -i -e 's/"bbbeasy /".\/bbbeasy /g' package.json`.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5- Run `yarn start-dev-installer` to enable the **installer** app or `yarn start-dev` to enable the **web** app.

## Contributing

## Security

## Testing

Backend test:

- From the browser: http://bbbeasy.test/api?statera or http://bbbeasy.test/api?statera=withCoverage

Frontend test:

- To start testing with Cypress, follow these steps :

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1- Enable the **installer** app as described in `Development` heading.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2- Run `yarn cypress`.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3- When the Command Prompt displays **Wait 30 seconds until enabling web app (manually)**, terminate the running installer app.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4- Run `yarn start-dev` within 30 seconds.

## Technologies

[![Fat-Free Framework](https://github.com/bcosca/fatfree/raw/master/ui/images/logo.png)](https://fatfreeframework.com)

[Node.js](https://nodejs.org/en/)

[React JS](https://reactjs.org/)

[Redis](https://redis.io/)

[Percona Distribution for PostgreSQL](https://www.percona.com/software/postgresql-distribution)

[TypeSCript](https://www.typescriptlang.org/)

[Cypress](https://www.cypress.io/)

[NGINX](https://www.nginx.com/)

[Vagrant](https://www.vagrantup.com/)
