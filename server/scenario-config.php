<?php

// All dialogue, response options, feedback and audio references
// for the Beat the Scammer prototype.

return [
    'audioBasePath' => 'assets/audio/',

    'narration' => [
        'home' => [
            'audioFile' => 'Home_Intro.mp3',
            'text' => "Welcome! I will help you practise recognising scam calls safely. Press below \"Start training\" button to continue.",
        ],

        'instructions' => [
            'audioFile' => 'Instructions_Intro.mp3',
            'text' => "Before we begin, I will explain how this training works. During this training: Listen carefully to the caller. Choose how you would respond. Think before taking action. Learn from your choices and feedback. This training may also use the voice of a participating family member.",
        ],

        'incomingCall' => [
            'audioFile' => 'IncomingCall_SwipeToAnswer.mp3',
            'text' => "Swipe to answer the call.",
        ],

        // Ringtone sound effect, no spoken words.
        'ringing' => [
            'audioFile' => 'IncomingCall_Ringing.mp3',
            'text' => '',
        ],
    ],

    'reflection' => [
        'audioFile' => 'Reflection_Question.mp3',

        'question' => "Let's reflect on the call. Do you think this caller could be an AI impersonation scam?",

        'options' => [
            [
                'optionId' => 'yes',
                'label' => 'Yes',
                'isCorrect' => true,
                'audioFile' => 'Reflection_Correct.mp3',
                'feedback' => "Correct! This call was an AI impersonation scam.",
            ],

            [
                'optionId' => 'no',
                'label' => 'No',
                'isCorrect' => false,
                'audioFile' => 'Reflection_Incorrect.mp3',
                'feedback' => "This call was an AI impersonation scam. The caller was not really your daughter.",
            ],

            [
                'optionId' => 'notsure',
                'label' => 'Not sure',
                'isCorrect' => false,
                'audioFile' => 'Reflection_NotSure.mp3',
                'feedback' => "This call was an AI impersonation scam. The caller was not really your daughter.",
            ],
        ],
    ],

    'scenarios' => [
        [
            'scenarioId' => 'scenario01',
            'title' => 'The Urgent Money Request',
            'summary' => "A caller claiming to be the user's daughter asks for money to be sent to a new account.",

            'caller' => [
                'name' => 'Emily',
                'number' => '0411 223 344',
                'relationship' => 'daughter',
            ],

            'startNodeId' => 'caller01',

            'nodes' => [
                // Decision 1
                'caller01' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller01.mp3',
                    'text' => "Hi Mum, it's me. I'm really sorry to call you like this, but I'm in a bit of trouble and I really need your help. I am stuck at a hotel and I need to pay for a room tonight. I've tried calling the bank, but I can't access my account. Can you please send me some money? I will give you my new account because my old one is not working.",
                    'responseIds' => ['user01', 'user02', 'user03'],
                ],

                'user01' => [
                    'type' => 'response',
                    'label' => "That sounds serious. Where are you exactly? I will call the hotel and check what's happened first.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good choice. Checking the story through an independent source helps verify who you are speaking to.",
                    'nextNodeId' => 'caller02A',
                ],

                'user02' => [
                    'type' => 'response',
                    'label' => "Oh no, I'm sorry you're stuck. Of course I will help you. How much money do you need?",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "Be careful. The caller created urgency and immediately asked for money before you verified the caller.",
                    'nextNodeId' => 'caller02B',
                ],

                'user03' => [
                    'type' => 'response',
                    'label' => "I'm worried about you. I'm going to call you back on your usual number first.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good choice. Calling back using a trusted number helps verify the caller independently.",
                    'nextNodeId' => 'caller02C',
                ],

                // Decision 2
                'caller02A' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller02A.mp3',
                    'text' => "I'm at the Grand Plaza Hotel. Please don't call anyone, Mum. I'm really embarrassed about what's happened. I just need you to send me the money so I can sort this out.",
                    'responseIds' => ['user04', 'user05', 'user06'],
                ],

                'user04' => [
                    'type' => 'response',
                    'label' => "I understand, but I'm still going to call the hotel myself before I do anything.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. The caller asked you not to contact anyone, so checking independently is important.",
                    'nextNodeId' => 'caller03A',
                ],

                'user05' => [
                    'type' => 'response',
                    'label' => "Okay, I won't call them. Just tell me what I need to do.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "This is risky because you accepted the caller's request for secrecy instead of checking the story.",
                    'nextNodeId' => 'caller03B',
                ],

                'user06' => [
                    'type' => 'response',
                    'label' => "If you're really my daughter, you should be okay with me checking this first.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. A genuine family member should understand why you need to verify an unusual request.",
                    'nextNodeId' => 'caller03C',
                ],

                'caller02B' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller02B.mp3',
                    'text' => "Thank you, Mum. I need \$800 to cover the room and some other expenses. Can you transfer it to me now? I'll pay you back as soon as I can.",
                    'responseIds' => ['user07', 'user08', 'user09'],
                ],

                'user07' => [
                    'type' => 'response',
                    'label' => "I understand, but I want to make sure it's really you before I send any money.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You are stopping the money transfer until you can verify the caller.",
                    'nextNodeId' => 'caller03D',
                ],

                'user08' => [
                    'type' => 'response',
                    'label' => "Okay, I understand. Just give me the account details.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "Be careful. You are agreeing to transfer money before confirming who you are speaking to.",
                    'nextNodeId' => 'caller03E',
                ],

                'user09' => [
                    'type' => 'response',
                    'label' => "Why can't you access your normal bank account? I want to understand what happened first.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "This is a cautious response, but you still need to independently verify the caller before taking action.",
                    'nextNodeId' => 'caller03F',
                ],

                'caller02C' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller02C.mp3',
                    'text' => "Mum, please don't call my normal number. My phone isn't working properly and I need you to help me right now. Just stay on this call with me.",
                    'responseIds' => ['user10', 'user11', 'user12'],
                ],

                'user10' => [
                    'type' => 'response',
                    'label' => "If your phone isn't working, I'll contact you another way that I already know is yours.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Using another trusted contact method avoids relying on the suspicious call.",
                    'nextNodeId' => 'caller03G',
                ],

                'user11' => [
                    'type' => 'response',
                    'label' => "Okay, I'll stay on the phone. Tell me what you need me to do.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "Be careful. Staying on the call prevents you from independently checking whether the caller is genuine.",
                    'nextNodeId' => 'caller03H',
                ],

                'user12' => [
                    'type' => 'response',
                    'label' => "This sounds unusual. I'm going to stop here and contact you through another method.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Stopping the call and using a trusted method is a strong way to verify identity.",
                    'nextNodeId' => 'caller03I',
                ],

                // Decision 3
                'caller03A' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03A.mp3',
                    'text' => "Mum, please don't call the hotel. I really don't want them involved. Can't you just trust me?",
                    'responseIds' => ['user13', 'user14', 'user15'],
                ],

                'user13' => [
                    'type' => 'response',
                    'label' => "I'm not sending money until I can confirm who I'm speaking to.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You are refusing to act until the caller's identity is independently confirmed.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user14' => [
                    'type' => 'response',
                    'label' => "Okay, I won't call the hotel. What account should I send the money to?",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "This accepts the caller's secrecy request and moves toward sending money without verification.",
                    'nextNodeId' => 'caller04Unsafe',
                ],

                'user15' => [
                    'type' => 'response',
                    'label' => "I'm going to hang up and contact you another way.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Contacting the person through a trusted method helps confirm their identity.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'caller03B' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03B.mp3',
                    'text' => "I just need you to transfer the money to the new account. I'll explain everything when I get home.",
                    'responseIds' => ['user16', 'user17', 'user18'],
                ],

                'user16' => [
                    'type' => 'response',
                    'label' => "I'm not transferring anything until I verify this with you another way.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You are refusing the transfer until you can verify the caller independently.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user17' => [
                    'type' => 'response',
                    'label' => "Okay, send me the account details and I'll transfer it.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "This is unsafe because you agreed to transfer money without verifying the caller.",
                    'nextNodeId' => 'caller04Unsafe',
                ],

                'user18' => [
                    'type' => 'response',
                    'label' => "Why do you need a new account? I'm going to check what's happening first.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Asking questions is useful, but you should still independently verify the caller before sending money.",
                    'nextNodeId' => 'caller04Unsure',
                ],

                'caller03C' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03C.mp3',
                    'text' => "I know, Mum. I'm sorry. I'm just really stressed and I need you to trust me.",
                    'responseIds' => ['user19', 'user20', 'user21'],
                ],

                'user19' => [
                    'type' => 'response',
                    'label' => "I care about you, but I'm still going to verify this before sending money.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Emotional pressure should not replace verification.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user20' => [
                    'type' => 'response',
                    'label' => "Okay, I trust you. Tell me where to send the money.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "Be careful. Trusting the caller without verification creates a risk of losing money.",
                    'nextNodeId' => 'caller04Unsafe',
                ],

                'user21' => [
                    'type' => 'response',
                    'label' => "I'm going to call you back on the number I already have for you.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. A known number gives you an independent way to check the caller.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'caller03D' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03D.mp3',
                    'text' => "Mum, it really is me. I just need you to help me. Please don't make this harder than it already is.",
                    'responseIds' => ['user22', 'user23', 'user24'],
                ],

                'user22' => [
                    'type' => 'response',
                    'label' => "I want to help, but I'm going to verify your identity first.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Helping someone does not mean skipping identity checks.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user23' => [
                    'type' => 'response',
                    'label' => "Okay, I believe you. Send me the account details.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller has not been independently verified, so sending money is risky.",
                    'nextNodeId' => 'caller04Unsafe',
                ],

                'user24' => [
                    'type' => 'response',
                    'label' => "What was the name of our first family pet?",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. A private shared memory can help you check the caller, although it should not be your only verification method.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'caller03E' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03E.mp3',
                    'text' => "Thank you, Mum. The account number is ready. I just need you to transfer the \$800 now.",
                    'responseIds' => ['user25', 'user26', 'user27'],
                ],

                'user25' => [
                    'type' => 'response',
                    'label' => "Before I send anything, I'm going to contact you using a number I already have.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Use a trusted number rather than relying on the number used by the caller.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user26' => [
                    'type' => 'response',
                    'label' => "Okay, send me the account details.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "You are moving toward a money transfer without independently verifying the caller.",
                    'nextNodeId' => 'caller04Unsafe',
                ],

                'user27' => [
                    'type' => 'response',
                    'label' => "I'm not comfortable sending money without checking this first.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Good caution. The next step should be independent verification before any transfer.",
                    'nextNodeId' => 'caller04Unsure',
                ],

                'caller03F' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03F.mp3',
                    'text' => "My bank account is locked and I can't get into it. That's why I need you to send the money to this new account.",
                    'responseIds' => ['user28', 'user29', 'user30'],
                ],

                'user28' => [
                    'type' => 'response',
                    'label' => "I'll contact the bank or check with you another way before doing anything.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Independent verification is more reliable than accepting the caller's explanation.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user29' => [
                    'type' => 'response',
                    'label' => "Okay, just send me the new account details.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "A new account combined with an urgent money request is a major warning sign.",
                    'nextNodeId' => 'caller04Unsafe',
                ],

                'user30' => [
                    'type' => 'response',
                    'label' => "That doesn't sound right. I'm going to verify this before I send anything.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You recognised that the new account and unusual explanation need checking.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'caller03G' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03G.mp3',
                    'text' => "Mum, please, I really need you to do this now. I don't have time to explain everything.",
                    'responseIds' => ['user31', 'user32', 'user33'],
                ],

                'user31' => [
                    'type' => 'response',
                    'label' => "If this is really you, you won't mind me taking a moment to verify it.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Urgency should not stop you from checking the caller.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user32' => [
                    'type' => 'response',
                    'label' => "Okay, tell me the account details.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller is using urgency to discourage you from checking the story.",
                    'nextNodeId' => 'caller04Unsafe',
                ],

                'user33' => [
                    'type' => 'response',
                    'label' => "I'm going to stop the call and contact you another way.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Ending the suspicious call gives you time to verify the situation independently.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'caller03H' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03H.mp3',
                    'text' => "I just need you to transfer the money. I promise I'll explain everything later.",
                    'responseIds' => ['user34', 'user35', 'user36'],
                ],

                'user34' => [
                    'type' => 'response',
                    'label' => "I'm not transferring anything until I verify who you are.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You are refusing to transfer money without verification.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user35' => [
                    'type' => 'response',
                    'label' => "Okay, how do I transfer it?",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "This moves directly toward the transfer without checking who the caller is.",
                    'nextNodeId' => 'caller04Unsafe',
                ],

                'user36' => [
                    'type' => 'response',
                    'label' => "I'm going to contact you another way first.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. A separate trusted contact method is safer than continuing the suspicious call.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'caller03I' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller03I.mp3',
                    'text' => "Mum, wait! Please don't hang up. I really need your help.",
                    'responseIds' => ['user37', 'user38', 'user39'],
                ],

                'user37' => [
                    'type' => 'response',
                    'label' => "I understand, but I'm going to verify this before doing anything.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You stayed cautious despite the emotional pressure.",
                    'nextNodeId' => 'caller04Safe',
                ],

                'user38' => [
                    'type' => 'response',
                    'label' => "Okay, I'll stay on the call. Tell me what you need.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "You have not agreed to send money, but staying on the call without verification still carries risk.",
                    'nextNodeId' => 'caller04Unsure',
                ],

                'user39' => [
                    'type' => 'response',
                    'label' => "I'm going to contact you through a number or method I already know.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Independent contact is the safest way to check the caller.",
                    'nextNodeId' => 'caller04Safe',
                ],

                // Decision 4
                'caller04Safe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller04Safe.mp3',
                    'text' => "Mum, why are you questioning me? I'm already stressed enough. Please just trust me and send the money.",
                    'responseIds' => ['user40', 'user41', 'user42'],
                ],

                'user40' => [
                    'type' => 'response',
                    'label' => "I still need to verify that this is really you before I do anything.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Keep verifying even when the caller becomes emotional.",
                    'nextNodeId' => 'caller05Safe',
                ],

                'user41' => [
                    'type' => 'response',
                    'label' => "I want to help, but tell me exactly what happened first.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Asking questions can slow the situation down, but independent verification is still needed.",
                    'nextNodeId' => 'caller05Unsure',
                ],

                'user42' => [
                    'type' => 'response',
                    'label' => "Okay, just give me the account details.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "Do not let emotional pressure push you into sending money without verification.",
                    'nextNodeId' => 'caller05Unsafe',
                ],

                'caller04Unsure' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller04Unsure.mp3',
                    'text' => "I need to pay for the room right now or they're going to make me leave. Please, Mum, I don't have much time.",
                    'responseIds' => ['user43', 'user44', 'user45'],
                ],

                'user43' => [
                    'type' => 'response',
                    'label' => "I'm going to verify this before sending anything.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Urgency is a reason to slow down and verify, not a reason to rush.",
                    'nextNodeId' => 'caller05Safe',
                ],

                'user44' => [
                    'type' => 'response',
                    'label' => "Why does the money have to be sent right now?",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Good question. However, you should still independently verify the caller before sending anything.",
                    'nextNodeId' => 'caller05Unsure',
                ],

                'user45' => [
                    'type' => 'response',
                    'label' => "Okay, I'll transfer the money.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller's urgency has pushed you into agreeing to send money without verification.",
                    'nextNodeId' => 'caller05Unsafe',
                ],

                'caller04Unsafe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller04Unsafe.mp3',
                    'text' => "Thank you. I'll give you the new account details. I need you to transfer the full \$800 as soon as possible.",
                    'responseIds' => ['user46', 'user47', 'user48'],
                ],

                'user46' => [
                    'type' => 'response',
                    'label' => "Actually, I want to check that this is really you first.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. It is never too late to stop and verify before sending money.",
                    'nextNodeId' => 'caller05Safe',
                ],

                'user47' => [
                    'type' => 'response',
                    'label' => "Wait, why is the account different?",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Noticing the different account is useful, but you should verify the caller before continuing.",
                    'nextNodeId' => 'caller05Unsure',
                ],

                'user48' => [
                    'type' => 'response',
                    'label' => "Okay, tell me where to send the $800.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "You are about to transfer money to a new account without verifying the caller.",
                    'nextNodeId' => 'caller05Unsafe',
                ],

                // Decision 5
                'caller05Safe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller05Safe.mp3',
                    'text' => "Mum, seriously? You know it's me. I can't think about family questions right now. I'm stressed and I just need your help.",
                    'responseIds' => ['user49', 'user50', 'user51'],
                ],

                'user49' => [
                    'type' => 'response',
                    'label' => "Tell me the name of our first family pet.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. A shared memory can help you check the caller, although independent verification is still important.",
                    'nextNodeId' => 'caller06Safe',
                ],

                'user50' => [
                    'type' => 'response',
                    'label' => "Why don't you want me to contact anyone else?",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Good question. Refusing independent verification is an important warning sign.",
                    'nextNodeId' => 'caller06Unsure',
                ],

                'user51' => [
                    'type' => 'response',
                    'label' => "Fine, I'll trust you. What do I need to do?",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller is using emotional pressure to make you stop questioning the situation.",
                    'nextNodeId' => 'caller06Unsafe',
                ],

                'caller05Unsure' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller05Unsure.mp3',
                    'text' => "There's nothing else to explain. My account isn't working, the hotel needs payment, and I need you to help me.",
                    'responseIds' => ['user52', 'user53', 'user54'],
                ],

                'user52' => [
                    'type' => 'response',
                    'label' => "Before we continue, answer a question only my daughter would know.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You are attempting to verify the caller instead of accepting the explanation.",
                    'nextNodeId' => 'caller06Safe',
                ],

                'user53' => [
                    'type' => 'response',
                    'label' => "I'm still not sure about this. Explain what happened again.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "It is good to remain cautious, but you should move toward independent verification.",
                    'nextNodeId' => 'caller06Unsure',
                ],

                'user54' => [
                    'type' => 'response',
                    'label' => "Okay, I'll stop asking questions. Tell me how to send it.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "Stopping your questions and preparing to send money removes your main protection against the scam.",
                    'nextNodeId' => 'caller06Unsafe',
                ],

                'caller05Unsafe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller05Unsafe.mp3',
                    'text' => "Okay, open your banking app. I'll give you the details. Please make sure you enter everything exactly as I tell you.",
                    'responseIds' => ['user55', 'user56', 'user57'],
                ],

                'user55' => [
                    'type' => 'response',
                    'label' => "Hold on. I need to make sure this is really you.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You stopped before completing the transfer and returned to verification.",
                    'nextNodeId' => 'caller06Safe',
                ],

                'user56' => [
                    'type' => 'response',
                    'label' => "I have the banking app open, but I'm still not sure about this.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Your hesitation is useful, but do not continue with the transfer until you independently verify the caller.",
                    'nextNodeId' => 'caller06Unsure',
                ],

                'user57' => [
                    'type' => 'response',
                    'label' => "I'm ready. Give me the account details.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "You are preparing to transfer money while still relying on the suspicious caller.",
                    'nextNodeId' => 'caller06Unsafe',
                ],

                // Decision 6
                'caller06Safe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller06Safe.mp3',
                    'text' => "Why don't you believe me? I'm your daughter. I can't believe you're making me prove myself when I'm in trouble.",
                    'responseIds' => ['user58', 'user59', 'user60'],
                ],

                'user58' => [
                    'type' => 'response',
                    'label' => "You didn't answer my question. I'm not sending anything.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You recognised that avoiding verification is a warning sign.",
                    'nextNodeId' => 'caller07Safe',
                ],

                'user59' => [
                    'type' => 'response',
                    'label' => "Why are you avoiding my question?",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Good observation. Keep the conversation stopped until the caller can be independently verified.",
                    'nextNodeId' => 'caller07Unsure',
                ],

                'user60' => [
                    'type' => 'response',
                    'label' => "Maybe you're just stressed. Tell me the account details.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller's emotional response should not convince you to provide money.",
                    'nextNodeId' => 'caller07Unsafe',
                ],

                'caller06Unsure' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller06Unsure.mp3',
                    'text' => "Mum, you're wasting time. I need to pay them now. Please stop asking questions and just help me.",
                    'responseIds' => ['user61', 'user62', 'user63'],
                ],

                'user61' => [
                    'type' => 'response',
                    'label' => "This isn't adding up. I'm going to verify the call.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You recognised the pressure and returned to independent verification.",
                    'nextNodeId' => 'caller07Safe',
                ],

                'user62' => [
                    'type' => 'response',
                    'label' => "I need you to explain why I can't contact anyone else.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "It is reasonable to question the secrecy, but independent verification is still the safest next step.",
                    'nextNodeId' => 'caller07Unsure',
                ],

                'user63' => [
                    'type' => 'response',
                    'label' => "Okay. I'll send the money.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller's urgency has pressured you into agreeing to the transfer.",
                    'nextNodeId' => 'caller07Unsafe',
                ],

                'caller06Unsafe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller06Unsafe.mp3',
                    'text' => "Good. Once you've entered the details, make sure the amount says $800. Tell me when you're ready to send it.",
                    'responseIds' => ['user64', 'user65', 'user66'],
                ],

                'user64' => [
                    'type' => 'response',
                    'label' => "I'm stopping. I need to verify who I'm talking to.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You stopped the transfer before sending the money.",
                    'nextNodeId' => 'caller07Safe',
                ],

                'user65' => [
                    'type' => 'response',
                    'label' => "Before I press send, why is this account different?",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Good question, but do not continue until the caller and account have been independently verified.",
                    'nextNodeId' => 'caller07Unsure',
                ],

                'user66' => [
                    'type' => 'response',
                    'label' => "Okay, I'm ready to make the transfer.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "You are now very close to completing the scam transfer.",
                    'nextNodeId' => 'caller07Unsafe',
                ],

                // Decision 7
                'caller07Safe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller07Safe.mp3',
                    'text' => "Please don't hang up. If you call anyone else, this is just going to take longer. I need you to help me now.",
                    'responseIds' => ['user67', 'user68', 'user69'],
                ],

                'user67' => [
                    'type' => 'response',
                    'label' => "No. I'm going to hang up and call you on your usual number.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Ending the call and using a known number is a strong independent check.",
                    'nextNodeId' => 'caller08Safe',
                ],

                'user68' => [
                    'type' => 'response',
                    'label' => "I'm not sending money yet, but I'll stay on the phone.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "You have not agreed to send money, but staying on the suspicious call still gives the caller control.",
                    'nextNodeId' => 'caller08Unsure',
                ],

                'user69' => [
                    'type' => 'response',
                    'label' => "Okay, I'll send it if you really need it.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller is using pressure to make you agree to the transfer.",
                    'nextNodeId' => 'caller08Unsafe',
                ],

                'caller07Unsure' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller07Unsure.mp3',
                    'text' => "I don't know what else I can say to convince you. I'm stuck here and you're the only person I can rely on.",
                    'responseIds' => ['user70', 'user71', 'user72'],
                ],

                'user70' => [
                    'type' => 'response',
                    'label' => "I've heard enough. I'm going to verify this another way.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You recognised that emotional pressure does not prove identity.",
                    'nextNodeId' => 'caller08Safe',
                ],

                'user71' => [
                    'type' => 'response',
                    'label' => "I'm still unsure. Give me a moment to think.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Taking time to think is better than rushing, but you should still verify the caller independently.",
                    'nextNodeId' => 'caller08Unsure',
                ],

                'user72' => [
                    'type' => 'response',
                    'label' => "Okay, I believe you. Let's make the transfer.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller's emotional pressure has convinced you to transfer money without verification.",
                    'nextNodeId' => 'caller08Unsafe',
                ],

                'caller07Unsafe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller07Unsafe.mp3',
                    'text' => "You're almost done. Please don't stop now. I need you to complete the transfer while I'm still on the phone.",
                    'responseIds' => ['user73', 'user74', 'user75'],
                ],

                'user73' => [
                    'type' => 'response',
                    'label' => "No. I've changed my mind. I'm going to verify this.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. It is always okay to stop a suspicious transaction before sending the money.",
                    'nextNodeId' => 'caller08Safe',
                ],

                'user74' => [
                    'type' => 'response',
                    'label' => "Wait. I'm not comfortable pressing send yet.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Good hesitation. Do not press send until the caller is independently verified.",
                    'nextNodeId' => 'caller08Unsure',
                ],

                'user75' => [
                    'type' => 'response',
                    'label' => "I've entered the details. What do I do next?",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "You have allowed the caller to guide you toward completing the transfer.",
                    'nextNodeId' => 'caller08Unsafe',
                ],

                // Decision 8
                'caller08Safe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller08Safe.mp3',
                    'text' => "Mum, please don't do that. Just stay on the phone with me. If you hang up, I don't know what I'm going to do.",
                    'responseIds' => ['user76', 'user77', 'user78'],
                ],

                'user76' => [
                    'type' => 'response',
                    'label' => "I'm ending this call and contacting my daughter directly.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Contacting your daughter directly through a trusted method is the safest option.",
                    'nextNodeId' => 'caller09Safe',
                ],

                'user77' => [
                    'type' => 'response',
                    'label' => "Give me one good reason why I shouldn't verify this first.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "You are still questioning the situation, but independent verification remains important.",
                    'nextNodeId' => 'caller09Unsure',
                ],

                'user78' => [
                    'type' => 'response',
                    'label' => "Fine. I'll help you.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller's emotional pressure has caused you to agree to help without verification.",
                    'nextNodeId' => 'caller09Unsafe',
                ],

                'caller08Unsure' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller08Unsure.mp3',
                    'text' => "Please believe me. I wouldn't be asking you for this if I had any other option. I need you to decide now.",
                    'responseIds' => ['user79', 'user80', 'user81'],
                ],

                'user79' => [
                    'type' => 'response',
                    'label' => "No. I'm going to contact my daughter myself.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Independent contact is the safest way to verify the caller.",
                    'nextNodeId' => 'caller09Safe',
                ],

                'user80' => [
                    'type' => 'response',
                    'label' => "I still don't know if I believe you.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "It is good not to rush. The next step should be independent verification.",
                    'nextNodeId' => 'caller09Unsure',
                ],

                'user81' => [
                    'type' => 'response',
                    'label' => "Okay, I'll do what you're asking.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "You have allowed urgency and emotional pressure to override independent verification.",
                    'nextNodeId' => 'caller09Unsafe',
                ],

                'caller08Unsafe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller08Unsafe.mp3',
                    'text' => "Please send it now. The hotel is waiting for the payment and I can't stay here much longer.",
                    'responseIds' => ['user82', 'user83', 'user84'],
                ],

                'user82' => [
                    'type' => 'response',
                    'label' => "Stop. I'm not sending anything until I verify this.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You stopped the transfer despite the continued pressure.",
                    'nextNodeId' => 'caller09Safe',
                ],

                'user83' => [
                    'type' => 'response',
                    'label' => "I'm still worried something isn't right.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Your concern is appropriate. Use a trusted method to verify before doing anything.",
                    'nextNodeId' => 'caller09Unsure',
                ],

                'user84' => [
                    'type' => 'response',
                    'label' => "Okay, I'm going to send the money now.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "This is the risky point where the scammer is attempting to complete the transfer.",
                    'nextNodeId' => 'caller09Unsafe',
                ],

                // Decision 9
                'caller09Safe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller09Safe.mp3',
                    'text' => "Mum, don't hang up. Please. I'm asking you one last time to trust me and help me.",
                    'responseIds' => ['user85', 'user86', 'user87'],
                ],

                'user85' => [
                    'type' => 'response',
                    'label' => "I'm hanging up and calling my daughter directly.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Excellent. You are independently verifying the caller rather than relying on the suspicious call.",
                    'nextNodeId' => null,
                ],

                'user86' => [
                    'type' => 'response',
                    'label' => "I'm going to contact another family member to check this.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. Using another trusted person is a useful independent check.",
                    'nextNodeId' => null,
                ],

                'user87' => [
                    'type' => 'response',
                    'label' => "I'll stay on the call and keep talking to you.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "You have not sent money, but staying on the call means the caller still controls the conversation.",
                    'nextNodeId' => null,
                ],

                'caller09Unsure' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller09Unsure.mp3',
                    'text' => "I really am your daughter. I need you to make a decision now. Are you going to help me or not?",
                    'responseIds' => ['user88', 'user89', 'user90'],
                ],

                'user88' => [
                    'type' => 'response',
                    'label' => "I'm ending the call and verifying this independently.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You have recognised the pressure and chosen independent verification.",
                    'nextNodeId' => null,
                ],

                'user89' => [
                    'type' => 'response',
                    'label' => "I'm not sending money, but I'm still not sure what's happening.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Not sending money is important. You should now independently verify the caller.",
                    'nextNodeId' => null,
                ],

                'user90' => [
                    'type' => 'response',
                    'label' => "Okay, I trust you. I'll send the money.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "The caller's pressure has caused you to agree to send money without independent verification.",
                    'nextNodeId' => null,
                ],

                'caller09Unsafe' => [
                    'type' => 'caller',
                    'audioFile' => 'Scenario01_Caller09Unsafe.mp3',
                    'text' => "Okay, everything should be ready. I just need you to press send now. Please do it before it's too late.",
                    'responseIds' => ['user91', 'user92', 'user93'],
                ],

                'user91' => [
                    'type' => 'response',
                    'label' => "No. I'm stopping the transfer and verifying who you are.",
                    'rating' => 'SAFE',
                    'coachFeedback' => "Good. You stopped the transfer before the money was sent.",
                    'nextNodeId' => null,
                ],

                'user92' => [
                    'type' => 'response',
                    'label' => "Wait. I need more time before I send anything.",
                    'rating' => 'UNSURE',
                    'coachFeedback' => "Taking time is safer than rushing, but you should independently verify the caller before sending anything.",
                    'nextNodeId' => null,
                ],

                'user93' => [
                    'type' => 'response',
                    'label' => "Okay, I'm sending the \$800 now.",
                    'rating' => 'UNSAFE',
                    'coachFeedback' => "This is the point where the scam succeeds because the money is being transferred without verification.",
                    'nextNodeId' => null,
                ],
            ],

            // Final feedback
            'feedback' => [
                'unsafe' => [
                    'audioFile' => 'Feedback_Intro.mp3',
                    'text' => "You've completed the scenario. The caller was using urgency, emotional pressure and a request for money to a new account. What you could improve is verifying the caller's identity before taking action. If someone you know suddenly asks for money, stop and contact them using a trusted phone number or another method you already know belongs to them.",
                    'warningSigns' => [
                        'Created urgency',
                        'Asked for money',
                        'Claimed to be a family member',
                        'Requested a new account number',
                        'Tried to stop independent verification',
                    ],
                    'reminders' => [
                        'Stay calm',
                        "Verify the caller's identity",
                        'Never send money immediately',
                        'Use a trusted contact method',
                    ],
                ],

                'safe' => [
                    'audioFile' => 'Feedback_Intro.mp3',
                    'text' => "You've completed the scenario. You recognised several warning signs and took steps to verify who you were speaking to before sending money. Keep using a trusted contact method and remember that urgency or emotional pressure should never force you to act before checking the situation.",
                    'warningSigns' => [
                        'Created urgency',
                        'Asked for money',
                        'Claimed to be a family member',
                        'Requested a new account number',
                        'Tried to stop independent verification',
                    ],
                    'reminders' => [
                        'Stay calm',
                        "Verify the caller's identity",
                        'Never send money immediately',
                        'Use a trusted contact method',
                    ],
                ],
            ],
        ],
    ],
];