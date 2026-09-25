# System Architecture

The system architecture shows the main components of the *Beat the Scammer* prototype and how the PHP pages, JavaScript, Client API Bridge, backend/server, shared layout and audio work together.

![system architecture diagram](../client/assets/images/system-architecture.png)

## Main Components

### PHP Web Application

The PHP files provide the main screens of the prototype. They are divided into normal pages and call-related screens.

### Shared Layout

`header.php`, `nav.php` and `footer.php` provide reusable layout components for the main non-call pages.

The `incoming-call.php` and `scenario.php` screens use a separate full-screen layout to simulate a phone call.

### JavaScript

The JavaScript files provide client-side interaction and control the communication between the user interface and the backend.

* `navigation.js` manages navigation and button interactions.
* `scenario.js` manages scenario behaviour and response logic.
* `state.js` manages the current scenario state and user choices.

JavaScript calls the Client API Bridge when backend data is required. It receives the returned data, updates the user interface, and controls audio playback.

### Scenario State

The scenario state keeps track of information required during the activity, such as the current scenario, the user's response, the safe or unsafe path, and the reflection choice.

### Audio

Pre-recorded audio is stored in `assets/audio/` and is used to simulate the caller's voice, coach's voice and call ringing sound.

JavaScript controls the audio playback when audio is required.

### Client API Bridge

The Client API Bridge provides the connection between the client-side JavaScript and the backend/server.

JavaScript calls the API bridge to send requests. The API bridge forwards these requests to the backend/server and returns the backend response to JavaScript.

### Backend / Server

The `server/` directory provides the backend functionality for processing requests and returning data to the client.

The backend receives requests forwarded by the Client API Bridge and returns the required response. This allows backend functionality to be integrated with the existing PHP and JavaScript front end without directly connecting the frontend to the server.

### User Interaction

The overall interaction begins with the PHP pages and user interface. JavaScript handles client-side interactions and communicates with the backend through the Client API Bridge when required.

The user's choices determine the safe, unsure or unsafe response path and later the AI voice or real person reflection path. JavaScript then updates the interface and controls audio playback based on the current scenario state and returned data.