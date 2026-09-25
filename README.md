# Beat the Scammer

**3027CCJ – ICT & The Justice System**
**Group 3:** Jorja Telford, Yuehui (Cherry) Chen, Luke Sloan

## Project Overview

Beat the Scammer is an interactive training application designed to help older adults recognise and respond to AI voice impersonation scams.

The user experiences a simulated scam phone call and makes decisions during the conversation. The application then provides feedback, reflection and practical prevention advice.

## User Experience

The application takes the user through a simulated scam call:

```text
Home  
 ↓  
Instructions  
 ↓  
Incoming Call  
 ↓  
Scenario / Conversation  
 ↓
User Response  
 ↓
Safe / Unsure/ Unsafe Response  
 ↓
Continue Scenario  
 ↓
Call Ends  
 ↓
Reflection  
 ↓
Feedback  
 ↓
AI Voice / Real Person  
 ↓
Explanation / Reveal  
 ↓
Prevention Tips  
 ↓
End
```

During the call, the user responds to the simulated caller using the available choices. Different choices lead to safe or unsafe response paths before returning to the main scenario.

After the call ends, the user provides feedback and completes a reflection activity. The reflection asks the user to identify whether the caller was an AI voice or a real person. The application then explains the result and provides practical scam prevention tips.

The prototype uses pre-recorded caller audio rather than live voice recognition.

## Features

* Simple button-based navigation
* Simulated incoming scam call
* Interactive conversation
* Safe, unsure and unsafe response paths
* Caller audio
* Feedback after the call
* AI voice / real person reflection
* Explanation and reveal
* Scam prevention tips
* Mobile-first interface

## How to Run

### Requirements

* PHP 8.x or later
* A modern web browser

### Start the application

Clone the repository and open the project directory:

```
git clone https://github.com/cherry4049/3027CCJ-Project.git
cd 3027CCJ-Project
```

Start the PHP development server:

```
php -S localhost:8000 -t client
```

Then open:

```
http://localhost:8000
```

The application will open on the Home screen.

## Project Structure

```text
3027CCJ-Project/
│
├── client/
│   ├── index.php
│   ├── family-voice.php
│   ├── instructions.php
│   ├── incoming-call.php
│   ├── scenario.php
│   ├── reflection.php
│   ├── feedback.php 
│   │
│   ├── includes/
│   │   ├── header.php
│   │   ├── nav.php
│   │   └── footer.php
│   │
│   ├── css/
│   │   └── style.css
│   │
│   │  
│   ├── api/
│   │   └── caller-turn.php
│   │
│   │
│   ├── js/
│   │   ├── navigation.js
│   │   ├── scenario.js
│   │   └── state.js
│   │
│   └── assets/
│       ├── audio/
│       └── images/
│
├── server/
│   ├── caller-turn.php
│   ├── scenario-config.php
│   └── scenario-engine.php
│
├── docs/
│   ├── application-flow.md
│   └── system-architecture.md
│
├── README.md
└── .gitignore
```

## Audio

All audio used by the prototype is stored in:

```
client/assets/audio/
```

JavaScript controls audio playback during the simulated call.

## Backend and API

The client communicates with the backend through the Client API Bridge:

```text
JavaScript  
    ↓  
client/api/caller-turn.php  
    ↓  
server/
```

The API bridge forwards requests to the backend and returns the response to JavaScript. JavaScript uses the returned data to update the interface and control the scenario.

## Documentation

Additional project documentation is available in the docs/ directory:

```
Application Flow
System Architecture
```

## Repository

[GitHub Repository](https://github.com/cherry4049/3027CCJ-Project)
