<?php
// All the dialogue, response options and feedback text for the prototype.
// Only Scenario 1 is used in the demo. Adding more scenarios is a change
// to this file, not to the code.

return [

    'audioBasePath' => 'assets/audio/',

    
    'narration' => [
        'home' => [
            'audioFile' => 'Home_Coach.mp3',
            'text' => "Hello, and welcome to Beat the Scammer. In this training, you will practise recognising and responding to suspicious phone calls. I\'ll guide you through each scenario and help you learn how to stay safe. When you\'re ready to begin, tap Start Training to continue. If you would like to learn how the training works first, tap How It Works.",
        ],
        'instructions' => [
            'audioFile' => 'Instruction_Coach.mp3',
            'text' => "Before we begin the training, let me explain how it works. In each scenario, you will receive a phone call from someone you know. Listen carefully to what the caller says and pay attention to anything that seems unusual or concerning. Respond naturally, just as you would if you received a real phone call. When the call ends, we will reflect on what happened and discuss the warning signs together. When you\'re ready to begin the first scenario, tap Continue. If you would like to leave the training, tap Exit.",
        ],
        'incomingCall' => [
            'audioFile' => 'IncomingCall_Coach.mp3',
            'text' => "Your first call is about to begin. When you\'re ready, swipe to answer the call.",
        ],
    ],

   
    'reflection' => [
        'audioFile' => 'Reflection_Coach.mp3',
        'question' => "Let\'s reflect on the call. Do you think this caller could be an AI impersonation scam?",
        'options' => [
            [
                'optionId' => 'yes',
                'label' => 'Yes',
                'isCorrect' => true,
                'audioFile' => 'Reflection_Feedback_Yes.mp3',
                'feedback' => "That\'s right. AI impersonation scams can sound very convincing, so it\'s important to look for unusual requests, pressure, or other warning signs.",
            ],
            [
                'optionId' => 'no',
                'label' => 'No',
                'isCorrect' => false,
                'audioFile' => 'Reflection_Feedback_No.mp3',
                'feedback' => "It\'s understandable if you didn\'t recognise it as an AI impersonation. AI impersonation scams can sound like someone you know, so it\'s important to look for unusual requests and verify the caller independently.",
            ],
            [
                'optionId' => 'notsure',
                'label' => 'Not sure',
                'isCorrect' => false,
                'audioFile' => 'Reflection_Feedback_NotSure.mp3',
                'feedback' => "That\'s okay. AI impersonation scams can be difficult to recognise. When something feels unusual, take a moment to stop and verify the caller another way.",
            ],
        ],
        'nextAudioFile' => 'Reflection_Next_Coach.mp3',
        'nextText' => "Now that you\'ve reflected on the call, when you\'re ready, tap Final Results to see what you did right, what you could improve, and some tips to help you stay safe.",
    ],

    'scenarios' => [

        [
            'scenarioId' => 'scenario01',
            'title' => 'The Urgent Money Request',
            'summary' => "A caller claiming to be the user\'s daughter asks for money to be sent to a new account.",

            'caller' => [
                'name' => 'Emily',
                'number' => '0411 223 344',
                'relationship' => 'daughter',
            ],

            'startNodeId' => 'caller01',

        
            'nodes' => [

                'caller01' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller01.mp3',
                    'text' => "Hi Mum, it's me. I'm really sorry to call you like this, but I'm in a bit of trouble and I really need your help. I am stuck at a hotel and I need to pay for a room tonight. I've tried calling the bank, but I can't access my account. Can you please send me some money? I will give you my new account because my old one is not working.",
                    'responseIds' => ['user01', 'user02', 'user03'],
                ],
                'user01' => [
                    'type' => 'response',
                    'label' => "Ask where he is and offer to call the hotel",
                    'text' => "That sounds serious. Where are you exactly? I'll call the hotel and check what's happened first.",
                    'isSafe' => true,
                    'coachFeedback' => "Good. Checking the story through an independent source is one of the best ways to expose an impersonation.",
                    'nextNodeId' => 'caller02a',
                ],
                'user02' => [
                    'type' => 'response',
                    'label' => "Agree to help and ask how much is needed",
                    'text' => "Oh no, I'm sorry you're stuck. Of course I'll help you. How much money do you need?",
                    'isSafe' => false,
                    'coachFeedback' => "Be careful. The caller created urgency and asked for money immediately. These are common signs of an impersonation scam.",
                    'nextNodeId' => 'caller02b',
                ],
                'user03' => [
                    'type' => 'response',
                    'label' => "Say you will call back on her usual number",
                    'text' => "Before I send anything, I want to make sure it's really you. I'll call you back on your usual number.",
                    'isSafe' => true,
                    'coachFeedback' => "Good. Calling back on a number you already have is one of the safest ways to check who you are speaking to.",
                    'nextNodeId' => 'caller02a',
                ],
                'caller02a' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller02A.mp3',
                    'text' => "I'm at the Grand Plaza Hotel. Please don't call anyone, Mum. I'm really embarrassed about what's happened. I just need you to send me the money so I can sort this out.",
                    'responseIds' => ['user04', 'user05', 'user06'],
                ],
                'user04' => [
                    'type' => 'response',
                    'label' => "Ask a question only your daughter would know",
                    'text' => "I understand, but I want to make sure it's really you before I send any money. If you're really my daughter, what was the name of our first family pet?",
                    'isSafe' => true,
                    'coachFeedback' => "Well done. A shared memory is something a cloned voice cannot answer.",
                    'nextNodeId' => 'caller03a',
                ],
                'user05' => [
                    'type' => 'response',
                    'label' => "Say you are contacting the hotel anyway",
                    'text' => "I understand, but I'm still going to contact the hotel before I send any money.",
                    'isSafe' => true,
                    'coachFeedback' => "Good. The caller asked you not to contact anyone, which is a warning sign in itself.",
                    'nextNodeId' => 'caller03b',
                ],
                'user06' => [
                    'type' => 'response',
                    'label' => "Agree not to call anyone and send the money",
                    'text' => "Okay, I understand. I won't call anyone. I'll send the money.",
                    'isSafe' => false,
                    'coachFeedback' => "Requests for secrecy are meant to stop you checking the story. Agreeing to them removes your best protection.",
                    'nextNodeId' => 'caller04c',
                ],
                'caller02b' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller02B.mp3',
                    'text' => "Thank you, Mum. I need \$800 to cover the room and some other expenses. Can you transfer it to me now? I'll pay you back as soon as I can.",
                    'responseIds' => ['user07', 'user08', 'user09'],
                ],
                'user07' => [
                    'type' => 'response',
                    'label' => "Ask why that much money is needed",
                    'text' => "Why do you need \$800? Can you explain exactly what happened?",
                    'isSafe' => true,
                    'coachFeedback' => "Good. Asking for detail slows the call down and gives you time to think.",
                    'nextNodeId' => 'caller03b',
                ],
                'user08' => [
                    'type' => 'response',
                    'label' => "Refuse until you have confirmed who it is",
                    'text' => "I can't transfer anything until I've confirmed that it's really you.",
                    'isSafe' => true,
                    'coachFeedback' => "Good. Holding your position under pressure is the right response here.",
                    'nextNodeId' => 'caller04b',
                ],
                'user09' => [
                    'type' => 'response',
                    'label' => "Agree to send the money",
                    'text' => "Okay, I'll send it. Just give me the account details.",
                    'isSafe' => false,
                    'coachFeedback' => "Agreeing to transfer money before verifying the caller is the point at which the loss happens.",
                    'nextNodeId' => 'caller04c',
                ],
                'caller03a' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03A.mp3',
                    'text' => "Mum, seriously? It was the dog we had when I was little. You know it's me. I don't have time for this. Please just help me.",
                    'responseIds' => ['user10', 'user11', 'user12'],
                ],
                'user10' => [
                    'type' => 'response',
                    'label' => "Say you will contact her another way",
                    'text' => "I'm still not comfortable sending money. I'm going to contact you another way to make sure it's really you.",
                    'isSafe' => true,
                    'coachFeedback' => "Good. A correct answer to one question does not prove identity, especially when the detail could be guessed or found online.",
                    'nextNodeId' => 'caller04a',
                ],
                'user11' => [
                    'type' => 'response',
                    'label' => "Refuse until you can verify her",
                    'text' => "I understand you're in trouble, but I won't send anything until I can verify you.",
                    'isSafe' => true,
                    'coachFeedback' => "Good. Staying with verification rather than the emotional pressure is the right call.",
                    'nextNodeId' => 'caller04b',
                ],
                'user12' => [
                    'type' => 'response',
                    'label' => "Accept the answer and send the money",
                    'text' => "Okay, okay. I know it's you. I'll send the money.",
                    'isSafe' => false,
                    'coachFeedback' => "Be careful. Details like a pet's name can be found on social media, so a correct answer does not confirm identity.",
                    'nextNodeId' => 'caller04c',
                ],
                'caller03b' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03B.mp3',
                    'text' => "Mum, please. I don't have time to explain everything. Just send the money now and I promise I'll pay you back.",
                    'responseIds' => ['user13', 'user14', 'user15'],
                ],
                'user13' => [
                    'type' => 'response',
                    'label' => "Refuse until you have confirmed who it is",
                    'text' => "I'm sorry, but I can't send money until I've confirmed that it's really you.",
                    'isSafe' => true,
                    'coachFeedback' => "Good. Repeated pressure is a reason to slow down, not to give in.",
                    'nextNodeId' => 'caller04b',
                ],
                'user14' => [
                    'type' => 'response',
                    'label' => "Say you will check with the hotel first",
                    'text' => "I'm going to contact the hotel and check what's happening before I do anything.",
                    'isSafe' => true,
                    'coachFeedback' => "Good. Checking the story independently is what an impersonator cannot survive.",
                    'nextNodeId' => 'caller04a',
                ],
                'user15' => [
                    'type' => 'response',
                    'label' => "Ask for the account details",
                    'text' => "Alright. Send me the account details and I'll transfer the money.",
                    'isSafe' => false,
                    'coachFeedback' => "The caller wore you down with repetition. Urgency that does not let up is itself a warning sign.",
                    'nextNodeId' => 'caller04c',
                ],
                'caller04a' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller04A.mp3',
                    'text' => "Fine, Mum. I'll call you back from my usual number. Just stay there and wait for me.",
                    'responseIds' => ['user16', 'user17', 'user18'],
                ],
                'user16' => [
                    'type' => 'response',
                    'label' => "Agree to wait for her usual number",
                    'text' => "Okay. I'll wait for your usual number before doing anything.",
                    'isSafe' => true,
                    'coachFeedback' => "Well done. Ending the call and waiting for contact on a known number is the safest outcome.",
                    'nextNodeId' => null,
                ],
                'user17' => [
                    'type' => 'response',
                    'label' => "Wait, but still refuse to send money",
                    'text' => "I'll wait for your call, but I still won't send any money until I know it's really you.",
                    'isSafe' => true,
                    'coachFeedback' => "Well done. You kept the condition on the money even after agreeing to wait.",
                    'nextNodeId' => null,
                ],
                'user18' => [
                    'type' => 'response',
                    'label' => "Send the money while you wait",
                    'text' => "Okay, I'll send the money while I wait.",
                    'isSafe' => false,
                    'coachFeedback' => "Sending money while waiting for verification defeats the purpose of waiting.",
                    'nextNodeId' => null,
                ],
                'caller04b' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller04B.mp3',
                    'text' => "Mum, I really need your help. Why won't you trust me? I'm your daughter. You should know it's me.",
                    'responseIds' => ['user19', 'user20', 'user21'],
                ],
                'user19' => [
                    'type' => 'response',
                    'label' => "Refuse until you can verify who it is",
                    'text' => "I know you're upset, but I'm not going to send money until I can verify who I'm speaking to.",
                    'isSafe' => true,
                    'coachFeedback' => "Well done. Guilt and hurt feelings are tools here, not evidence of identity.",
                    'nextNodeId' => null,
                ],
                'user20' => [
                    'type' => 'response',
                    'label' => "Say you will use a number you already have",
                    'text' => "I'm going to contact you using a number I already have for you.",
                    'isSafe' => true,
                    'coachFeedback' => "Well done. Using a number you already hold is the single most reliable check.",
                    'nextNodeId' => null,
                ],
                'user21' => [
                    'type' => 'response',
                    'label' => "Apologise and send the money",
                    'text' => "I'm sorry. I'll trust you and send it now.",
                    'isSafe' => false,
                    'coachFeedback' => "The caller used your guilt to end the questioning. That is exactly when to stop, not to pay.",
                    'nextNodeId' => 'caller04c',
                ],
                'caller04c' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller04C.mp3',
                    'text' => "Thank you, Mum. I'll send you the account details now. Please transfer it as soon as you can.",
                    'responseIds' => ['user22', 'user23', 'user24'],
                ],
                'user22' => [
                    'type' => 'response',
                    'label' => "Refuse until you have verified the account",
                    'text' => "I'm not going to transfer anything until I've verified the account and spoken to you another way.",
                    'isSafe' => true,
                    'coachFeedback' => "Well done. A new account number for a familiar person is a warning sign on its own.",
                    'nextNodeId' => null,
                ],
                'user23' => [
                    'type' => 'response',
                    'label' => "Say you will check the details first",
                    'text' => "I'll check the details first before I make any transfer.",
                    'isSafe' => true,
                    'coachFeedback' => "Well done. Checking before transferring is the last point at which the money can be saved.",
                    'nextNodeId' => null,
                ],
                'user24' => [
                    'type' => 'response',
                    'label' => "Transfer the money",
                    'text' => "Okay, I'll transfer it now.",
                    'isSafe' => false,
                    'coachFeedback' => "This is the point the scam succeeds. Transfers to a new account are very hard to reverse.",
                    'nextNodeId' => null,
                ],
            ],

            
            'feedback' => [

                'unsafe' => [
                    'audioFile' => 'Scenario01_Feedback_Coach.mp3',
                    'text' => "You\'ve completed this scenario. Let\'s review what happened. You did not recognise that the caller was creating urgency and asking you to send money to a new account. What you could improve is verifying the caller\'s identity before taking action. If someone you know suddenly asks for money, take a moment to stop and check that it is really them. Contact the person using a trusted phone number rather than relying on the number they called from.",
                    'warningSigns' => [
                        'Created urgency',
                        'Asked for money',
                        'Claimed to be a family member',
                        'Requested a new account number',
                    ],
                    'reminders' => [
                        'Stay calm',
                        "Verify the caller\'s identity",
                        'Never send money immediately',
                        'Contact the person using a trusted phone number',
                    ],
                ],

                
                'safe' => [
                    'audioFile' => null,
                    'text' => "Well done. You\'ve completed this scenario. You recognised that the caller was creating urgency and asking for money to be sent to a new account, and you chose to check who you were speaking to before acting. What you could improve is continuing to verify through a trusted contact method even when the caller says there is no time.",
                    'warningSigns' => [
                        'Created urgency',
                        'Asked for money',
                        'Claimed to be a family member',
                        'Requested a new account number',
                    ],
                    'reminders' => [
                        'Stay calm',
                        "Verify the caller\'s identity",
                        'Never send money immediately',
                        'Contact the person using a trusted phone number',
                    ],
                ],

            ],
        ],

    ],
];
