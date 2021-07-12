var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;
var SpeechRecognitionEvent = SpeechRecognitionEvent || webkitSpeechRecognitionEvent;

var synth = window.speechSynthesis;

var inputForm = document.querySelector('#login-form');
var emailInput = document.querySelector('input[name="log_email"]');
var passwordInput = document.querySelector('input[name="log_password"]');
var allInput = [emailInput];
var messageTxt = ['Bienvenue sur le didacticiel pour tous. Veuillez donner votre pseudo'];
var lang = 'fr-FR';

var pitch = 1;
var rate = 1;
var indexTxt = 0;
var voices = [];

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

function testSpeech(textInput) {
  // To ensure case consistency while checking with the returned output text
  textInput.value = '';

  var recognition = new SpeechRecognition();
  // recognition.lang = 'en-US';
  recognition.lang = lang;
  recognition.interimResults = false;
  recognition.maxAlternatives = 1;

  recognition.start();

  recognition.onresult = function(event) {
    // The SpeechRecognitionEvent results property returns a SpeechRecognitionResultList object
    // The SpeechRecognitionResultList object contains SpeechRecognitionResult objects.
    // It has a getter so it can be accessed like an array
    // The first [0] returns the SpeechRecognitionResult at position 0.
    // Each SpeechRecognitionResult object contains SpeechRecognitionAlternative objects that contain individual results.
    // These also have getters so they can be accessed like arrays.
    // The second [0] returns the SpeechRecognitionAlternative at position 0.
    // We then return the transcript property of the SpeechRecognitionAlternative object 
    var speechResult = event.results[0][0].transcript.toLowerCase();
    textInput.value = speechResult;

    console.log('Confidence: ' + event.results[0][0].confidence);
  }

  recognition.onspeechend = async function() {
    recognition.stop();

    await sleep(2500);

    indexTxt++;
    if (indexTxt < messageTxt.length) {
      speak();
    } else {
      inputForm.submit();
    }
  
    console.log('onspeechend: onspeechend');
}

  recognition.onerror = function(event) {
    // textInput.value = 'Error occurred in recognition: ' + event.error;
  }
  
  recognition.onaudiostart = function(event) {
      //Fired when the user agent has started to capture audio.
      console.log('SpeechRecognition.onaudiostart');
  }
  
  recognition.onaudioend = function(event) {
      //Fired when the user agent has finished capturing audio.
      console.log('SpeechRecognition.onaudioend');
  }
  
  recognition.onend = function(event) {
      //Fired when the speech recognition service has disconnected.
      console.log('SpeechRecognition.onend');
  }
  
  recognition.onnomatch = function(event) {
      //Fired when the speech recognition service returns a final result with no significant recognition. This may involve some degree of recognition, which doesn't meet or exceed the confidence threshold.
      console.log('SpeechRecognition.onnomatch');
  }
  
  recognition.onsoundstart = function(event) {
      //Fired when any sound — recognisable speech or not — has been detected.
      console.log('SpeechRecognition.onsoundstart');
  }
  
  recognition.onsoundend = function(event) {
      //Fired when any sound — recognisable speech or not — has stopped being detected.
      console.log('SpeechRecognition.onsoundend');
  }
  
  recognition.onspeechstart = function (event) {
      //Fired when sound that is recognised by the speech recognition service as speech has been detected.
      console.log('SpeechRecognition.onspeechstart');
  }
  recognition.onstart = function(event) {
      //Fired when the speech recognition service has begun listening to incoming audio with intent to recognize grammars associated with the current SpeechRecognition.
      console.log('SpeechRecognition.onstart');
  }
}

function populateVoiceList() {
  voices = synth.getVoices().sort(function (a, b) {
      const aname = a.name.toUpperCase(), bname = b.name.toUpperCase();
      if ( aname < bname ) return -1;
      else if ( aname == bname ) return 0;
      else return +1;
  });
}

populateVoiceList();
if (speechSynthesis.onvoiceschanged !== undefined) {
  speechSynthesis.onvoiceschanged = populateVoiceList;
}

function speak(){
  if (synth.speaking) {
      console.error('speechSynthesis.speaking');
      return;
  }
  if (messageTxt[indexTxt] !== '') {
    var utterThis = new SpeechSynthesisUtterance(messageTxt[indexTxt]);
    utterThis.onend = function (event) {
      testSpeech(allInput[indexTxt]);
      console.log('SpeechSynthesisUtterance.onend');
    }
    utterThis.onerror = function (event) {
        console.error('SpeechSynthesisUtterance.onerror');
    }
    var selectedOption = lang;
    for(i = 0; i < voices.length ; i++) {
      if(voices[i].lang === selectedOption) {
        utterThis.voice = voices[i];
        break;
      }
    }
    utterThis.pitch = pitch;
    utterThis.rate = rate;
    synth.speak(utterThis);
  }
}

document.body.onclick = function() {
  if (indexTxt < messageTxt.length) {
    speak();
  }
}
