self.addEventListener("install", e => { 
    e.waitUntil(
    caches.open("static").then(cache => {
        return cache.addAll(["./", "./css/app.css", "./img2.png"]);
    })
    );
 });

 self.addEventListener("fetch", e => {
 console.log (`Intercepting  request for : ${e.request.url}`);
});