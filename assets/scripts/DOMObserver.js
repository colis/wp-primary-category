const observeDOM = (function() {
  const MutationObserver = window.MutationObserver || window.WebKitMutationObserver,
        eventListenerSupported = window.addEventListener;

  return function(obj, callback) {
    if( MutationObserver ) {
      let obs = new MutationObserver(function(mutations, observer) {
        if( mutations[0].addedNodes.length )
          callback(mutations);
        });
        obs.observe( obj, { childList:true, subtree:true });
    } else if( eventListenerSupported ) {
      obj.addEventListener('DOMNodeInserted', callback, false);
      obj.addEventListener('DOMNodeRemoved', callback, false);
    }
  };
})();
