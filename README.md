# Beat the Scammer

**3027CCJ – ICT & The Justice System**
**Group 3:** Jorja Telford, Yuehui (Cherry) Chen, Luke Sloan

## Project Overview

Beat the Scammer is an interactive training prototype designed to help older adults recognise and respond to AI voice impersonation scams.

The prototype simulates a scam phone call using pre-recorded or mock audio. Users navigate the scenario using buttons, make decisions during the simulated call, follow different response paths and receive feedback and scam prevention advice.

The prototype is designed to demonstrate the core user journey without requiring live voice recognition technology. A future real-world version could use live voice interaction to make the simulated phone call more realistic.

## Project Objectives

The prototype aims to:

* Help users recognise common AI impersonation scam techniques.
* Identify warning signs such as urgency and emotional manipulation.
* Practise safer responses to suspicious callers.
* Encourage users to verify caller identity before taking action.
* Provide feedback that reinforces safer decision-making.

## Technology

The prototype is planned to use:

* HTML
* PHP
* CSS
* JavaScript
* Pre-recorded or mock audio
* Visual Studio Code
* Git and GitHub

PHP will be used for the page structure and shared layouts. CSS will be used for styling, while JavaScript will manage client-side interaction and scenario state where required.

The final backend technology and audio implementation will be determined during development.

## Project Structure

```text
3027CCJ-Project/
│
├── client/
│   ├── index.php
│   ├── instructions.php
│   ├── incoming-call.php
│   ├── scenario.php
│   ├── feedback.php
│   ├── reflection.php
│   ├── prevention-tips.php
│   │
│   ├── includes/
│   │   ├── header.php
│   │   ├── nav.php
│   │   └── footer.php
│   │
│   ├── css/
│   │   └── style.css
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
│   └── [backend files to be added]
│
├── docs/
│   ├── application-flow.md
│   └── system-architecture.md
│
├── README.md
└── .gitignore
```

The `client` folder contains the user-facing application. The `server` folder is reserved for backend development. The backend structure will be updated once the backend technology and implementation approach have been confirmed.

## Application Flow

The planned user flow is:

```text
Home
  ↓
Instructions
  ↓
Incoming Scam Call
  ↓
Conversation
  ↓
User Response
  ↓
Safe / Unsafe Response Path
  ↓
Feedback
  ↓
Continue
  ↓
Reflection
  ↓
Prevention Tips
```

The exact number of decision points and branching paths may be adjusted during development.

## Development Roles

The project development responsibilities are currently divided as follows:

**Jorja Telford**

* Front-end implementation
* PHP page development
* HTML/CSS implementation
* Interface styling and user interaction

**Luke Sloan**

* Backend implementation
* Backend technology selection
* Audio-related backend functionality

**Yuehui (Cherry) Chen**

* Front-end and backend integration
* File and project structure
* File skeleton and project setup
* Application flow and system architecture diagrams
* Development documentation
* Git and GitHub management

Responsibilities may be adjusted during development if required to maintain a balanced workload.

## Development Status

### Current Progress

* Low-fidelity prototype completed and updated for button-based navigation.
* Application flow planned.
* Technology stack identified.
* Initial project structure created.
* Development responsibilities allocated.
* GitHub repository established.
* Front-end and server folders prepared.

### Next Steps

* Finalise the application flow and scenario.
* Complete the initial front-end implementation.
* Determine the backend approach.
* Implement and connect backend functionality.
* Add simulated audio.
* Test navigation, branching and application functionality.
* Refine the prototype.
* Prepare the final presentation and report.

## Repository

This repository contains the development files for the **Beat the Scammer** prototype for 3027CCJ ICT & The Justice System.

The project will be updated throughout the development process.
