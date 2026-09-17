<?php



$pageTitle = 'Training Scenario';


/*
    GET CURRENT DECISION
*/

$decision = isset($_GET['decision'])
    ? (int) $_GET['decision']
    : 1;


/*
    GET CURRENT PATH
*/

$path = isset($_GET['path'])
    ? $_GET['path']
    : 'START';


$totalDecisions = 9;


/*
    SCENARIO DATA
*/

$scenarios = [

    /*
        ==================================================
        DECISION 1
        ==================================================
    */

    '1_START' => [

        'caller' => 'Scenario01_Caller01.mp3',

        'callerText' => "Hi Mum, it's me. I'm really sorry to call you like this, but I'm in a bit of trouble and I really need your help. I am stuck at a hotel and I need to pay for a room tonight. I've tried calling the bank, but I can't access my account. Can you please send me some money? I will give you my new account because my old one is not working.",

        'responses' => [

            "That sounds serious. Where are you exactly? I will call the hotel and check what's happened first.",

            "Oh no, I'm sorry you're stuck. Of course I will help you. How much money do you need?",

            "I'm worried about you. I'm going to call you back on your usual number first."

        ],

        'next' => [

            '2_A',
            '2_B',
            '2_C'

        ],

        'ratings' => [

            'SAFE',
            'UNSAFE',
            'SAFE'

        ],

        'feedback' => [

            "Checking the hotel's story independently is a strong response. You are not relying only on information provided by the caller, which makes it harder for a scammer to control the situation.",

            "Offering to help with the payment before verifying the caller is risky. The caller has created urgency and you have accepted their story without independently checking it.",

            "Calling your daughter back using her usual number is a strong verification step. It allows you to confirm her identity using contact information you already trust."

        ]

    ],


    /*
        ==================================================
        DECISION 2A
        ==================================================
    */

    '2_A' => [

        'caller' => 'Scenario01_Caller02A.mp3',

        'callerText' => "I'm at the Grand Plaza Hotel. Please don't call anyone, Mum. I'm really embarrassed about what's happened. I just need you to send me the money so I can sort this out.",

        'responses' => [

            "I understand, but I'm still going to call the hotel myself before I do anything.",

            "Okay, I won't call them. Just tell me what I need to do.",

            "If you're really my daughter, you should be okay with me checking this first."

        ],

        'next' => [

            '3_A',
            '3_B',
            '3_C'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'SAFE'
        ],

        'feedback' => [

            "Calling the hotel independently is a strong verification step. You are checking the caller's story using a source they do not control.",

            "Agreeing not to contact the hotel removes an important opportunity to verify the caller's story. Scammers often discourage victims from contacting other people or organisations.",

            "Questioning why the caller objects to verification is a strong response. A genuine family member should understand why you want to confirm an unusual request before sending money."

        ]



    ],


    /*
        ==================================================
        DECISION 2B
        ==================================================
    */

    '2_B' => [

        'caller' => 'Scenario01_Caller02B.mp3',

        'callerText' => "Thank you, Mum. I need $800 to cover the room and some other expenses. Can you transfer it to me now? I'll pay you back as soon as I can.",

        'responses' => [

            "I understand, but I want to make sure it's really you before I send any money.",

            "Okay, I understand. Just give me the account details.",

            "Why can't you access your normal bank account? I want to understand what happened first."

        ],

        'next' => [

            '3_D',
            '3_E',
            '3_F'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'UNSURE'
        ],

        'feedback' => [

            "Pausing before sending money and verifying the caller's identity is a strong response. An urgent request for money should always be independently checked.",

            "Accepting new account details without verifying the caller is risky. Once money is transferred to a scammer-controlled account, recovering it may be difficult.",

            "Questioning why the caller cannot access their normal account shows caution. However, you should still independently verify their identity before continuing."

        ]

    ],


    /*
        ==================================================
        DECISION 2C
        ==================================================
    */

    '2_C' => [

        'caller' => 'Scenario01_Caller02C.mp3',

        'callerText' => "Mum, please don't call my normal number. My phone isn't working properly and I need you to help me right now. Just stay on this call with me.",

        'responses' => [

            "If your phone isn't working, I'll contact you another way that I already know is yours.",

            "Okay, I'll stay on the phone. Tell me what you need me to do.",

            "This sounds unusual. I'm going to stop here and contact you through another method."

        ],

        'next' => [

            '3_G',
            '3_H',
            '3_I'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'SAFE'
        ],

        'feedback' => [

            "Contacting your daughter through a method you already trust is a strong verification strategy. It prevents the caller from controlling how you communicate.",

            "Staying on the call and agreeing to follow the caller's instructions is risky. Scammers may try to keep victims on the phone so they cannot independently verify the situation.",

            "Stopping the call and contacting your daughter another way is a strong response. Independent contact can quickly reveal whether the emergency is genuine."

        ]

    ],


    /*
        ==================================================
        DECISION 3A
        ==================================================
    */

    '3_A' => [

        'caller' => 'Scenario01_Caller03A.mp3',

        'callerText' => "Mum, please don't call the hotel. I really don't want them involved. Can't you just trust me?",

        'responses' => [

            "I'm not sending money until I can confirm who I'm speaking to.",

            "Okay, I won't call the hotel. What account should I send the money to?",

            "I'm going to hang up and contact you another way."

        ],

        'next' => [

            '4_SAFE',
            '4_UNSAFE',
            '4_SAFE'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'SAFE'
        ],

        'feedback' => [

            "Refusing to send money until the caller's identity is confirmed is a strong protective response.",

            "Agreeing not to verify the story and asking for the account details allows the caller to move the scam towards payment.",

            "Ending the call and contacting your daughter independently removes the scammer's control of the conversation and allows you to verify the situation."

        ]

    ],


    /*
        ==================================================
        DECISION 3B
        ==================================================
    */

    '3_B' => [

        'caller' => 'Scenario01_Caller03B.mp3',

        'callerText' => "I just need you to transfer the money to the new account. I'll explain everything when I get home.",

        'responses' => [

            "I'm not transferring anything until I verify this with you another way.",

            "Okay, send me the account details and I'll transfer it.",

            "Why do you need a new account? I'm going to check what's happening first."

        ],

        'next' => [

            '4_SAFE',
            '4_UNSAFE',
            '4_UNSURE'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'UNSURE'
        ],

        'feedback' => [

            "Refusing to transfer money until you verify the caller is a strong response. Verification should happen independently of the incoming call.",

            "Agreeing to receive the account details without verification increases the risk of transferring money to a scammer.",

            "Questioning the new account is a useful warning sign to notice. However, you should also stop and independently verify the caller before continuing."

        ]

    ],


    /*
        ==================================================
        DECISION 3C
        ==================================================
    */

    '3_C' => [

        'caller' => 'Scenario01_Caller03C.mp3',

        'callerText' => "I know, Mum. I'm sorry. I'm just really stressed and I need you to trust me.",

        'responses' => [

            "I care about you, but I'm still going to verify this before sending money.",

            "Okay, I trust you. Tell me where to send the money.",

            "I'm going to call you back on the number I already have for you."

        ],

        'next' => [

            '4_SAFE',
            '4_UNSAFE',
            '4_SAFE'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'SAFE'
        ],

        'feedback' => [

            "You acknowledged the caller's distress without allowing the emotional pressure to override verification. This is a strong response.",

            "Trusting the caller solely because they sound convincing is risky. AI-generated voices can imitate someone you know.",

            "Calling your daughter using the number you already have is a strong independent verification method."

        ]

    ],


    /*
        ==================================================
        DECISION 3D
        ==================================================
    */

    '3_D' => [

        'caller' => 'Scenario01_Caller03D.mp3',

        'callerText' => "Mum, it really is me. I just need you to help me. Please don't make this harder than it already is.",

        'responses' => [

            "I want to help, but I'm going to verify your identity first.",

            "Okay, I believe you. Send me the account details.",

            "What was the name of our first family pet?"

        ],

        'next' => [

            '4_SAFE',
            '4_UNSAFE',
            '4_SAFE'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'SAFE'
        ],

        'feedback' => [

            "Wanting to help while still requiring identity verification balances concern with a strong safety response.",

            "Accepting the caller's claim and requesting account details without verification increases your risk of being scammed.",

            "Asking a personal question can provide another check on the caller's identity. However, independently contacting the person through a trusted method is even stronger."

        ]

    ],


    /*
        ==================================================
        DECISION 3E
        ==================================================
    */

    '3_E' => [

        'caller' => 'Scenario01_Caller03E.mp3',

        'callerText' => "Thank you, Mum. The account number is ready. I just need you to transfer the $800 now.",

        'responses' => [

            "Before I send anything, I'm going to contact you using a number I already have.",

            "Okay, send me the account details.",

            "I'm not comfortable sending money without checking this first."

        ],

        'next' => [

            '4_SAFE',
            '4_UNSAFE',
            '4_UNSURE'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'UNSURE'
        ],

        'feedback' => [

            "Using a number you already trust before transferring money is a strong way to independently verify the request.",

            "Proceeding to new account details without checking the caller's identity allows the scam to progress towards payment.",

            "Refusing to immediately send money shows caution. The next safest step would be to independently contact your daughter and verify the situation."

        ]

    ],


    /*
        ==================================================
        DECISION 3F
        ==================================================
    */

    '3_F' => [

        'caller' => 'Scenario01_Caller03F.mp3',

        'callerText' => "My bank account is locked and I can't get into it. That's why I need you to send the money to this new account.",

        'responses' => [

            "I'll contact the bank or check with you another way before doing anything.",

            "Okay, just send me the new account details.",

            "That doesn't sound right. I'm going to verify this before I send anything."

        ],

        'next' => [

            '4_SAFE',
            '4_UNSAFE',
            '4_SAFE'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'SAFE'
        ],

        'feedback' => [

            "Checking the situation independently before taking action is a strong response to an unusual banking explanation.",

            "Accepting new account details simply because the caller says their normal account is locked is risky. The explanation has not been independently verified.",

            "Recognising that the explanation seems unusual and stopping to verify it is a strong protective response."

        ]

    ],


    /*
        ==================================================
        DECISION 3G
        ==================================================
    */

    '3_G' => [

        'caller' => 'Scenario01_Caller03G.mp3',

        'callerText' => "Mum, please, I really need you to do this now. I don't have time to explain everything.",

        'responses' => [

            "If this is really you, you won't mind me taking a moment to verify it.",

            "Okay, tell me the account details.",

            "I'm going to stop the call and contact you another way."

        ],

        'next' => [

            '4_SAFE',
            '4_UNSAFE',
            '4_SAFE'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'SAFE'
        ],

        'feedback' => [

            "Refusing to let urgency prevent verification is a strong response. Time pressure is commonly used to encourage rushed decisions.",

            "Agreeing to receive account details because the caller says there is no time to explain allows urgency to influence your decision.",

            "Ending the call and independently contacting your daughter is a strong way to verify whether the emergency is genuine."

        ]

    ],


    /*
        ==================================================
        DECISION 3H
        ==================================================
    */

    '3_H' => [

        'caller' => 'Scenario01_Caller03H.mp3',

        'callerText' => "I just need you to transfer the money. I promise I'll explain everything later.",

        'responses' => [

            "I'm not transferring anything until I verify who you are.",

            "Okay, how do I transfer it?",

            "I'm going to contact you another way first."

        ],

        'next' => [

            '4_SAFE',
            '4_UNSAFE',
            '4_SAFE'

        ],

        'ratings' => [
            'SAFE',
            'UNSAFE',
            'SAFE'
        ],

        'feedback' => [

            "Refusing to transfer money until the caller is verified protects you from acting on an unconfirmed emergency.",

            "Asking how to make the transfer moves the interaction closer to payment without first confirming the caller's identity.",

            "Contacting your daughter through another trusted method is a strong verification step."

        ]

    ],


    /*
        ==================================================
        DECISION 3I
        ==================================================
    */

    '3_I' => [

        'caller' => 'Scenario01_Caller03I.mp3',

        'callerText' => "Mum, wait! Please don't hang up. I really need your help.",

        'responses' => [

            "I understand, but I'm going to verify this before doing anything.",

            "Okay, I'll stay on the call. Tell me what you need.",

            "I'm going to contact you through a number or method I already know."

        ],

        'next' => [

            '4_SAFE',
            '4_UNSURE',
            '4_SAFE'

        ],

        'ratings' => [
            'SAFE',
            'UNSURE',
            'SAFE'
        ],

        'feedback' => [

            "Maintaining your decision to verify the caller despite their emotional appeal is a strong protective response.",

            "Remaining on the call shows some hesitation, but it allows the caller to continue applying pressure. Independent verification would be safer.",

            "Using contact information you already trust is a strong way to confirm whether your daughter actually needs help."

        ]

    ],


    /*
        ==================================================
        DECISION 4 - SAFE
        ==================================================
    */

    '4_SAFE' => [

        'caller' => 'Scenario01_Caller04Safe.mp3',

        'callerText' => "Mum, why are you questioning me? I'm already stressed enough. Please just trust me and send the money.",

        'responses' => [

            "I still need to verify that this is really you before I do anything.",

            "I want to help, but tell me exactly what happened first.",

            "Okay, just give me the account details."

        ],

        'next' => [

            '5_SAFE',
            '5_UNSURE',
            '5_UNSAFE'

        ],

        'feedback' => [

            "Continuing to insist on verification despite the caller becoming frustrated is a strong response. Emotional pressure should not replace proof of identity.",

            "Asking for more information shows caution, but the caller still controls the information you receive. Independent verification would be safer.",

            "Agreeing to receive the account details allows the caller's pressure to move the interaction towards payment without verification."

        ]

    ],


    /*
        DECISION 4 - UNSURE
    */

    '4_UNSURE' => [

        'caller' => 'Scenario01_Caller04Unsure.mp3',

        'callerText' => "I need to pay for the room right now or they're going to make me leave. Please, Mum, I don't have much time.",

        'responses' => [

            "I'm going to verify this before sending anything.",

            "Why does the money have to be sent right now?",

            "Okay, I'll transfer the money."

        ],

        'next' => [

            '5_SAFE',
            '5_UNSURE',
            '5_UNSAFE'

        ],

        'feedback' => [

            "Stopping to verify the situation instead of responding to the deadline is a strong response to urgency.",

            "Questioning why payment is so urgent shows caution, but you are still relying on the caller's explanation rather than independently checking it.",

            "Agreeing to transfer money because of an urgent deadline is risky. Urgency is designed to reduce the time you have to question the request."

        ]

    ],


    /*
        DECISION 4 - UNSAFE
    */

    '4_UNSAFE' => [

        'caller' => 'Scenario01_Caller04Unsafe.mp3',

        'callerText' => "Thank you. I'll give you the new account details. I need you to transfer the full $800 as soon as possible.",

        'responses' => [

            "Actually, I want to check that this is really you first.",

            "Wait, why is the account different?",

            "Okay, tell me where to send the $800."

        ],

        'next' => [

            '5_SAFE',
            '5_UNSURE',
            '5_UNSAFE'

        ],

        'feedback' => [

            "Changing course before sending money and deciding to verify the caller is a strong recovery from the earlier risky decisions.",

            "Questioning why the account details have changed shows caution. However, you should stop the transfer and independently verify the caller.",

            "Continuing towards an $800 transfer to new account details is highly risky because neither the caller nor the payment request has been independently verified."

        ]

    ],


    /*
        ==================================================
        DECISION 5
        ==================================================
    */

    '5_SAFE' => [

        'caller' => 'Scenario01_Caller05Safe.mp3',

        'callerText' => "Mum, seriously? You know it's me. I can't think about family questions right now. I'm stressed and I just need your help.",

        'responses' => [

            "Tell me the name of our first family pet.",

            "Why don't you want me to contact anyone else?",

            "Fine, I'll trust you. What do I need to do?"

        ],

        'next' => [

            '6_SAFE',
            '6_UNSURE',
            '6_UNSAFE'

        ],

        'feedback' => [

            "Asking a personal verification question can help test whether the caller knows information expected of your daughter, although independent contact remains safer.",

            "Questioning why the caller wants to isolate you from other people recognises an important warning sign, but independent verification should still follow.",

            "Deciding to trust the caller because they sound stressed allows emotional pressure to override the need for verification."

        ]

    ],

    '5_UNSURE' => [

        'caller' => 'Scenario01_Caller05Unsure.mp3',

        'callerText' => "There's nothing else to explain. My account isn't working, the hotel needs payment, and I need you to help me.",

        'responses' => [

            "Before we continue, answer a question only my daughter would know.",

            "I'm still not sure about this. Explain what happened again.",

            "Okay, I'll stop asking questions. Tell me how to send it."

        ],

        'next' => [

            '6_SAFE',
            '6_UNSURE',
            '6_UNSAFE'

        ],

        'feedback' => [

            "Asking a question only your daughter should know adds another identity check before you take action.",

            "Continuing to ask for an explanation shows caution, but a convincing scammer may simply provide more fabricated details. Independent verification is safer.",

            "Stopping your questions and asking how to send the money allows the caller to move the scam towards payment."

        ]

    ],

    '5_UNSAFE' => [

        'caller' => 'Scenario01_Caller05Unsafe.mp3',

        'callerText' => "Okay, open your banking app. I'll give you the details. Please make sure you enter everything exactly as I tell you.",

        'responses' => [

            "Hold on. I need to make sure this is really you.",

            "I have the banking app open, but I'm still not sure about this.",

            "I'm ready. Give me the account details."

        ],

        'next' => [

            '6_SAFE',
            '6_UNSURE',
            '6_UNSAFE'

        ],

        'feedback' => [

            "Stopping before using your banking app and returning to identity verification is a strong way to interrupt the scam.",

            "Recognising that something still feels wrong is useful, but opening the banking app keeps you close to completing the scammer's requested transfer.",

            "Opening your banking app and asking for the account details puts you at significant risk of transferring money to the scammer."

        ]

    ],


    /*
        ==================================================
        DECISION 6
        ==================================================
    */

    '6_SAFE' => [

        'caller' => 'Scenario01_Caller06Safe.mp3',

        'callerText' => "Why don't you believe me? I'm your daughter. I can't believe you're making me prove myself when I'm in trouble.",

        'responses' => [

            "You didn't answer my question. I'm not sending anything.",

            "Why are you avoiding my question?",

            "Maybe you're just stressed. Tell me the account details."

        ],

        'next' => [

            '7_SAFE',
            '7_UNSURE',
            '7_UNSAFE'

        ],

        'feedback' => [

            "Noticing that the caller avoided your verification question and refusing to send money is a strong response.",

            "Recognising that the caller is avoiding your question shows caution. The safest next step is to end the call and verify independently.",

            "Excusing the caller's behaviour as stress and moving towards the account details allows emotional manipulation to influence your decision."

        ]

    ],

    '6_UNSURE' => [

        'caller' => 'Scenario01_Caller06Unsure.mp3',

        'callerText' => "Mum, you're wasting time. I need to pay them now. Please stop asking questions and just help me.",

        'responses' => [

            "This isn't adding up. I'm going to verify the call.",

            "I need you to explain why I can't contact anyone else.",

            "Okay. I'll send the money."

        ],

        'next' => [

            '7_SAFE',
            '7_UNSURE',
            '7_UNSAFE'

        ],

        'feedback' => [

            "Recognising that the story does not add up and deciding to verify it is a strong response.",

            "Questioning why the caller wants to prevent outside contact recognises a warning sign, although independent verification is still needed.",

            "Agreeing to send the money because the caller is pressuring you for time is risky and allows urgency to control your decision."

        ]

    ],

    '6_UNSAFE' => [

        'caller' => 'Scenario01_Caller06Unsafe.mp3',

        'callerText' => "Good. Once you've entered the details, make sure the amount says $800. Tell me when you're ready to send it.",

        'responses' => [

            "I'm stopping. I need to verify who I'm talking to.",

            "Before I press send, why is this account different?",

            "Okay, I'm ready to make the transfer."

        ],

        'next' => [

            '7_SAFE',
            '7_UNSURE',
            '7_UNSAFE'

        ],

        'feedback' => [

            "Stopping immediately before the transfer and deciding to verify the caller is a strong recovery action.",

            "Questioning the changed account before pressing send shows caution, but you should stop the transaction completely until the caller is verified.",

            "Being ready to complete the transfer places you at immediate financial risk because the request has not been independently verified."

        ]

    ],


    /*
        ==================================================
        DECISION 7
        ==================================================
    */

    '7_SAFE' => [

        'caller' => 'Scenario01_Caller07Safe.mp3',

        'callerText' => "Please don't hang up. If you call anyone else, this is just going to take longer. I need you to help me now.",

        'responses' => [

            "No. I'm going to hang up and call you on your usual number.",

            "I'm not sending money yet, but I'll stay on the phone.",

            "Okay, I'll send it if you really need it."

        ],

        'next' => [

            '8_SAFE',
            '8_UNSURE',
            '8_UNSAFE'

        ],

        'feedback' => [

            "Ending the incoming call and calling your daughter on her usual number is one of the strongest verification actions available.",

            "Refusing to send money is safer, but staying on the call allows the caller to continue applying emotional pressure.",

            "Agreeing to send money because the caller says they really need it allows emotional pressure to override verification."

        ]

    ],

    '7_UNSURE' => [

        'caller' => 'Scenario01_Caller07Unsure.mp3',

        'callerText' => "I don't know what else I can say to convince you. I'm stuck here and you're the only person I can rely on.",

        'responses' => [

            "I've heard enough. I'm going to verify this another way.",

            "I'm still unsure. Give me a moment to think.",

            "Okay, I believe you. Let's make the transfer."

        ],

        'next' => [

            '8_SAFE',
            '8_UNSURE',
            '8_UNSAFE'

        ],

        'feedback' => [

            "Deciding that you have heard enough and independently verifying the situation is a strong response.",

            "Taking time to think is better than immediately acting, but you should also end the call and verify the request independently.",

            "Deciding to believe the caller and proceed with the transfer without verification creates a high risk of financial loss."

        ]

    ],

    '7_UNSAFE' => [

        'caller' => 'Scenario01_Caller07Unsafe.mp3',

        'callerText' => "You're almost done. Please don't stop now. I need you to complete the transfer while I'm still on the phone.",

        'responses' => [

            "No. I've changed my mind. I'm going to verify this.",

            "Wait. I'm not comfortable pressing send yet.",

            "I've entered the details. What do I do next?"

        ],

        'next' => [

            '8_SAFE',
            '8_UNSURE',
            '8_UNSAFE'

        ],

        'feedback' => [

            "Changing your mind before completing the transfer and returning to verification is a strong recovery response.",

            "Recognising your discomfort before pressing send is important. The safest action is to stop the transaction and verify independently.",

            "Continuing after entering the payment details places you very close to completing the scammer's requested transaction."

        ]

    ],


    /*
        ==================================================
        DECISION 8
        ==================================================
    */

    '8_SAFE' => [

        'caller' => 'Scenario01_Caller08Safe.mp3',

        'callerText' => "Mum, please don't do that. Just stay on the phone with me. If you hang up, I don't know what I'm going to do.",

        'responses' => [

            "I'm ending this call and contacting my daughter directly.",

            "Give me one good reason why I shouldn't verify this first.",

            "Fine. I'll help you."

        ],

        'next' => [

            '9_SAFE',
            '9_UNSURE',
            '9_UNSAFE'

        ],

        'feedback' => [

            "Ending the call and contacting your daughter directly prevents the caller from continuing to pressure you and provides independent verification.",

            "Challenging the caller shows caution, but asking the suspected scammer to justify why you should not verify them still leaves them in control of the explanation.",

            "Giving in after repeated emotional pressure allows the caller's persistence to overcome the safer decisions you made earlier."

        ]

    ],

    '8_UNSURE' => [

        'caller' => 'Scenario01_Caller08Unsure.mp3',

        'callerText' => "Please believe me. I wouldn't be asking you for this if I had any other option. I need you to decide now.",

        'responses' => [

            "No. I'm going to contact my daughter myself.",

            "I still don't know if I believe you.",

            "Okay, I'll do what you're asking."

        ],

        'next' => [

            '9_SAFE',
            '9_UNSURE',
            '9_UNSAFE'

        ],

        'feedback' => [

            "Refusing the caller's pressure and contacting your daughter yourself is a strong independent verification response.",

            "Remaining uncertain is better than immediately sending money, but the safest action is to stop the call and verify the situation.",

            "Agreeing to follow the caller's instructions because they demand an immediate decision is risky."

        ],

    ],

    '8_UNSAFE' => [

        'caller' => 'Scenario01_Caller08Unsafe.mp3',

        'callerText' => "Please send it now. The hotel is waiting for the payment and I can't stay here much longer.",

        'responses' => [

            "Stop. I'm not sending anything until I verify this.",

            "I'm still worried something isn't right.",

            "Okay, I'm going to send the money now."

        ],

        'next' => [

            '9_SAFE',
            '9_UNSURE',
            '9_UNSAFE'

        ],

        'feedback' => [

            "Stopping the payment process and requiring verification is a strong recovery response, even late in the interaction.",

            "Recognising that something is wrong is important, but you should stop the transaction rather than remain in the payment process.",

            "Sending the money in response to the caller's urgent deadline would complete the scammer's objective."

        ]

    ],


    /*
        ==================================================
        DECISION 9 - FINAL DECISION
        ==================================================
    */

    '9_SAFE' => [

        'caller' => 'Scenario01_Caller09Safe.mp3',

        'callerText' => "Mum, don't hang up. Please. I'm asking you one last time to trust me and help me.",

        'responses' => [

            "I'm hanging up and calling my daughter directly.",

            "I'm going to contact another family member to check this.",

            "I'll stay on the call and keep talking to you."

        ],

        'next' => [

            'END_SAFE',
            'END_SAFE',
            'END_UNSURE'

        ],

        'ratings' => [
            'SAFE',
            'SAFE',
            'UNSURE'
        ],

        'feedback' => [

            "Ending the call and contacting your daughter directly is a strong final response. It verifies the situation using a trusted communication channel.",

            "Contacting another family member to independently check the situation is also a strong verification response.",

            "Not sending money is safer, but remaining on the call allows the suspected scammer to continue applying pressure."

        ],

    ],

    '9_UNSURE' => [

        'caller' => 'Scenario01_Caller09Unsure.mp3',

        'callerText' => "I really am your daughter. I need you to make a decision now. Are you going to help me or not?",

        'responses' => [

            "I'm ending the call and verifying this independently.",

            "I'm not sending money, but I'm still not sure what's happening.",

            "Okay, I trust you. I'll send the money."

        ],

        'next' => [

            'END_SAFE',
            'END_UNSURE',
            'END_UNSAFE'

        ],

        'feedback' => [

            "Ending the call and independently verifying the situation is the strongest response to the caller's final pressure.",

            "Refusing to send money protects you from immediate financial loss, although independently verifying your daughter's safety should be the next step.",

            "Trusting the caller and agreeing to send money without independent verification would allow the scam to succeed."

        ]

    ],

    '9_UNSAFE' => [

        'caller' => 'Scenario01_Caller09Unsafe.mp3',

        'callerText' => "Okay, everything should be ready. I just need you to press send now. Please do it before it's too late.",

        'responses' => [

            "No. I'm stopping the transfer and verifying who you are.",

            "Wait. I need more time before I send anything.",

            "Okay, I'm sending the $800 now."

        ],

        'next' => [

            'END_SAFE',
            'END_UNSURE',
            'END_UNSAFE'

        ],

        'feedback' => [

            "Stopping the transfer before pressing send and independently verifying the caller prevents the scam from being completed.",

            "Pausing before sending is better than completing the transfer, but the safest action is to cancel the transaction and independently verify the request.",

            "Pressing send would complete the $800 transfer based entirely on an unverified call and would represent the highest-risk response."

        ]

    ]

];


/*
    ==================================================
    FIND CURRENT SCENARIO
    ==================================================
*/

$scenarioKey = $decision . '_' . $path;


/*
    If someone enters an invalid URL,
    send them back to Decision 1.
*/

if (!isset($scenarios[$scenarioKey])) {

    $decision = 1;
    $path = 'START';
    $scenarioKey = '1_START';

}


$currentScenario = $scenarios[$scenarioKey];


include 'includes/header.php';

?>


<section class="screen scenario-screen">


    <!-- TRAINING SCENARIO -->

    <div class="training-label">

        Training Scenario

    </div>


    <!-- CALL TIMER -->

    <div
        class="call-timer"
        id="call-timer"
    >
        00:00
    </div>


    <!-- PROGRESS -->

    <div class="progress">

        Decision

        <?php echo $decision; ?>

        of

        <?php echo $totalDecisions; ?>

    </div>


    <!-- CALLER MESSAGE -->

    <div class="message-bubble caller-message">

        <strong>

            🔊 Caller:

        </strong>

        <p>

            <?php
                if (isset($currentScenario['callerText'])) {

                echo htmlspecialchars(
                    $currentScenario['callerText']
                );

                } else {

                    echo "Caller dialogue coming soon.";

                }
            ?>

        </p>

    </div>


    <!-- QUESTION -->

    <h2>

        What would you do?

    </h2>


    <!-- RESPONSE BUTTONS -->

<!-- RESPONSE BUTTONS -->

<div class="response-buttons">

<?php foreach (
    $currentScenario['responses']
    as $index => $response
): ?>

    <?php

        /*
            Get the next branch.
        */

        $next =
            $currentScenario['next'][$index];


        /*
            Get the rating.

            If this scenario has a custom
            rating array, use it.

            Otherwise:
            Response 1 = SAFE
            Response 2 = UNSURE
            Response 3 = UNSAFE
        */

        if (
            isset(
                $currentScenario[
                    'ratings'
                ][$index]
            )
        ) {

            $rating =
                $currentScenario[
                    'ratings'
                ][$index];

        } else {

            $defaultRatings = [
                'SAFE',
                'UNSURE',
                'UNSAFE'
            ];

            $rating =
                $defaultRatings[$index];
        }


        /*
            Get personalised feedback.

            If custom feedback exists for
            this exact response, use it.

            Otherwise use the generic
            fallback feedback.
        */

        if (
            isset(
                $currentScenario[
                    'feedback'
                ][$index]
            )
        ) {

            $feedback =
                $currentScenario[
                    'feedback'
                ][$index];

        }
        elseif ($rating === 'SAFE') {

            $feedback =
                "This was a safer response because you slowed down the interaction and avoided immediately following the caller's instructions.";

        }
        elseif ($rating === 'UNSURE') {

            $feedback =
                "You showed some caution, but there were safer ways to verify the caller before continuing the conversation.";

        }
        else {

            $feedback =
                "This response increased your risk because you continued following the caller's instructions without independently verifying their identity.";

        }


        /*
            Store the caller dialogue so it
            can be displayed later on the
            Final Results page.
        */

        $callerText =
            $currentScenario[
                'callerText'
            ] ?? '';


        /*
            Work out where the response
            button should go next.
        */

        if (
            $next === 'END_SAFE' ||
            $next === 'END_UNSURE' ||
            $next === 'END_UNSAFE'
        ) {

            $result =
                str_replace(
                    'END_',
                    '',
                    $next
                );

            $href =
                'reflection.php?result=' .
                urlencode($result);

        } else {

            $nextParts =
                explode(
                    '_',
                    $next,
                    2
                );

            $nextDecision =
                $nextParts[0];

            $nextPath =
                $nextParts[1] ??
                'START';

            $href =
                'scenario.php?decision=' .
                urlencode(
                    $nextDecision
                ) .
                '&path=' .
                urlencode(
                    $nextPath
                );
        }

    ?>

    <a
        href="<?php echo htmlspecialchars($href); ?>"
        class="response-button"
        data-decision="<?php echo htmlspecialchars($decision); ?>"
        data-rating="<?php echo htmlspecialchars($rating); ?>"
        data-response="<?php echo htmlspecialchars($response); ?>"
        data-feedback="<?php echo htmlspecialchars($feedback); ?>"
        data-caller="<?php echo htmlspecialchars($callerText); ?>"
        onclick="handleScenarioChoice(this); return false;"
    >
        <?php echo htmlspecialchars($response); ?>
    </a>

<?php endforeach; ?>

</div>


    <!-- BACK BUTTON -->

    <div class="button-group">


        <?php if ($decision === 1): ?>


            <a
                href="incoming-call.php"
                class="button secondary-button"
            >

                Back

            </a>


        <?php else: ?>


            <!--
                Because this is now a branching scenario,
                a simple decision - 1 URL may not represent
                the actual previous branch.

                For now, browser history is used so the
                player returns to the page they actually
                came from.
            -->

            <button
                type="button"
                class="button secondary-button"
                onclick="history.back();"
            >

                Back

            </button>


        <?php endif; ?>


    </div>


</section>


<?php

include 'includes/footer.php';

?>