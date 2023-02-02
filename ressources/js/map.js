// On initialise la latitude et la longitude de la carte
var lat = 50.6333;
var lon = 3.0582;
var macarte = null;
            
// On définit les points d'interet
var interpts =
{
    "Mairie": { "lat": 50.63093, "lon": 3.0709 },
	"Répu": { "lat": 50.63079, "lon": 3.06211 },
    "Citadelle" : { "lat": 50.6409, "lon": 3.0446}
}

const listepts = Object.keys(interpts);


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

function markerInfo()
{
    const markers = document.querySelectorAll(".leaflet-marker-icon");
    for (let i = 0; i < markers.length ; index++)
    {
        const element = array[index];
    }
}



