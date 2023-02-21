// On initialise la latitude et la longitude de la carte
var lat = 50.6333;
var lon = 3.0582;
var macarte = null;
lieu = [];

// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
window.onload = function () {
    startJson();
};

// Récupération du fichier json
function startJson() {
    const urljson = "./ressources/js/lieu.json";
    fetch(urljson).then(handleFetch);
}

// Vérification que le fichier json est bien récupéré
function handleFetch(responseText) {
    if (responseText.ok) {
        responseText.json()
            .then(showResult)
            .catch(error => console.log(error))
    }
    else {
        console.log(responseText.status, responseText.statusText);
    }
}

// Traitement du fichier json et déclenchement de la création de la map et des markers
function showResult(data) {
    lieu = data;
    initMap();
    markerInfo();
}

// Fonction d'initialisation de la carte
function initMap() {
    // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
    macarte = L.map('map').setView([lat, lon], 11);
    // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
        {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 14,
            maxZoom: 20
        }).addTo(macarte);

    // L.Routing.control({
    //     waypoints: [
    //         L.latLng(50.63093, 3.0709),
    //         L.latLng(50.63079, 3.06211)
    //     ],
    //     routeWhileDragging: true
    // }).addTo(macarte);


    // Nous ajoutons les marqueurs
    lieu.forEach(lieu => {
        var marker = L.marker([lieu.lat, lieu.lon]).addTo(macarte);
    });
}

// function qui ajoute l'eventListener sur chaques marqueurs
function markerInfo() {
    const markers = document.querySelectorAll(".leaflet-marker-icon");
    for (let i = 0; i < markers.length; i++) {
        markers[i].addEventListener("click", () => showInfo(i));
    }
}

// Fonction déclenchée lorsqu'on clique sur un marqueur (version création de la div via JS)
function showInfo(i)
{
    const a = document.createElement("div");
    const b = document.createElement("div");
    document.body.append(a,b);
    a.classList.add("infol");
    b.classList.add("infor");
    const h2 = document.createElement("h2");
    h2.innerText = lieu[i].nomLieu;
    const divimg = document.createElement("div");
    divimg.classList.add("image");
    const img = document.createElement("img");
    img.src = `./ressources/img/${lieu[i].image}`
    const adresse = document.createElement("span");
    adresse.innerText= `${lieu[i].adresse}`
    a.append(h2, divimg, adresse);
    divimg.append(img);
    const question = document.createElement("span");    
    question.classList.add("question");
    question.innerText = lieu[i].question;
    const reponse = document.createElement("ul");
    const choix1 = document.createElement("li");
    choix1.classList.add("reponse")
    choix1.innerText = lieu[i].choix1;
    const choix2 = document.createElement("li");
    choix2.classList.add("reponse")
    choix2.innerText = lieu[i].choix2;    
    const choix3 = document.createElement("li");
    choix3.classList.add("reponse")
    choix3.innerText = lieu[i].choix3;
    const choix4 = document.createElement("li");
    choix4.classList.add("reponse")
    choix4.innerText = lieu[i].choix4;  
    b.append(question, reponse);
    reponse.append(choix1, choix2, choix3, choix4);
    const map = document.querySelector("footer");
    setTimeout(() => {
        a.classList.add("active");
        b.classList.add("active");
    },200);

    
    map.addEventListener("click",()=>{
        a.classList.remove("active");
        b.classList.remove("active");
        setTimeout(() => {
            document.body.removeChild(a);
            document.body.removeChild(b);
    })})
}

