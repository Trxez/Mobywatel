
if (window.innerHeight < 730) {
    const metaViewport = document.querySelector('meta[name="viewport"]');
    metaViewport.setAttribute('content', 'width=device-width, initial-scale=0.8, maximum-scale=0.8, user-scalable=no');
}
else if (window.innerHeight < 820) {
    const metaViewport = document.querySelector('meta[name="viewport"]');
    metaViewport.setAttribute('content', 'width=device-width, initial-scale=0.9, maximum-scale=0.9, user-scalable=no');
}
else if (window.innerWidth < 375){
    const metaViewport = document.querySelector('meta[name="viewport"]');
    metaViewport.setAttribute('content', 'width=device-width, initial-scale=0.9, maximum-scale=0.9, user-scalable=no');
}