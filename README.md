# Vue Websocket Chat

## Introduction

Vue Websocket Chat is a chatting application built in Vue and PHP. It runs on a propietary server built in PHP and compiled into a handy PHAR package. The client communicates with the server using web sockets to ensure instant communication between users on the server.

## Setup

To set up the client, run the following command:

```
npm install
```

To test the application and automatically compile changes, run:

```
npm run serve
```

To compile for production, run:

```
npm run build
```

To run an instance of the web server, use:

```
npm run server
```

## Usage

The application is configured by default to run on localhost, but this can be changed to any server. Simply modify 'src/lib/socket.js' and look for the following:

```
Vue.use(new VueSocketIO({
    debug: true,
    connection: 'http://localhost:3000'
}))

```

Change the 'connection' parameter in the socket object to any server. Ensure the port is configured to 3000, as this is the port the server runs on. Ensuring the server is running, the client should now connect.
