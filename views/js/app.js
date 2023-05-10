// If the navigator detect a serviceWorker
if ("serviceWorker" in navigator) {
    // The navigator will registerr the serviceWorker.js file and all its directives by the way
    navigator.serviceWorker.register('/serviceWorker.js');
}