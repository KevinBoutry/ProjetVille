// On initialise la latitude et la longitude de la carte
var lat = 50.6333;
var lon = 3.0582;
var macarte = null;
            
// Récupération du fichier json
const urljson = "./ressources/js/lieu.json";
fetch(urljson).then(handleFetch);

function handleFetch(responseText)
{
    if(responseText.ok)
    {
        responseText.json()
            .then(showResult)
            .catch(error=>console.log(error))
    }
    else
    {
        console.log(responseText.status, responseText.statusText);
    }
}
function showResult(data)
{
    var lieu = data
}



// On définit les points d'interet
var interpts =
{
    "Mairie": { "lat": 50.63093, "lon": 3.0709 },
	"Répu": { "lat": 50.63079, "lon": 3.06211 },
    "Citadelle" : { "lat": 50.6409, "lon": 3.0446}
}


// Fonction d'initialisation de la carte
function initMap() 
{
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

    // Nous ajoutons les marqueurs
    for (interpt in interpts) {
		var marker = L.marker([interpts[interpt].lat, interpts[interpt].lon]).addTo(macarte);
	}   
}

// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
window.onload = function(){
    initMap();
    markerInfo();
};

// function qui ajoute l'eventListener sur chaques marqueurs
function markerInfo()
{
    const markers = document.querySelectorAll(".leaflet-marker-icon");
    for (let i = 0; i < markers.length ; i++)
    {
        markers[i].addEventListener("click",(i)=>showInfo(i));
    }
}

// Fonction déclenchée lorsqu'on clique sur un marqueur
function showInfo(marker)
{
    const a = document.createElement("div");
    const b = document.createElement("div");
    document.body.append(a,b);
    a.classList.add("infol");
    b.classList.add("infor");
    const map = document.querySelector("footer");
    map.addEventListener("click",()=>{
        document.body.removeChild(a);
        document.body.removeChild(b);
    })

}

