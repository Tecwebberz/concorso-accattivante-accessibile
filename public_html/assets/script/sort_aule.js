
const deg2rad = (deg) => deg * Math.PI / 180;
const computeDistance = (pos1, pos2) => {
    const earthRadiusKm = 6371;
    const deltaLat = deg2rad(pos2.lat - pos1.lat);
    const deltaLon = deg2rad(pos2.lon - pos1.lon);
    
    const alpha =
    Math.pow(Math.sin(deltaLat / 2), 2) +
    Math.cos(deg2rad(pos1.lat)) * Math.cos(deg2rad(pos2.lat)) *
    Math.pow(Math.sin(deltaLon / 2), 2);
    const norm = 2 * Math.atan2(Math.sqrt(alpha), Math.sqrt(1 - alpha));
    return earthRadiusKm * norm;
};

const sort = () => {
    const btn = document.getElementById("order");
    btn.disabled = true;
    btn.setAttribute("aria-disabled", "true");

    // Triggerato iff da il permesso ed è supportato
    navigator.geolocation.getCurrentPosition(pos => {
        const aule = document.querySelectorAll(".cards .card");
        
        // Aggiungi informazio sulla distanza
        aule.forEach(aula => {
            const distance = computeDistance({
                lat: parseFloat(aula.dataset.lat),
                lon: parseFloat(aula.dataset.lon)
            }, {
                lat: pos.coords.latitude,
                lon: pos.coords.longitude
            }, );
            aula.dataset.distance = distance;

            const extraSection = aula.querySelector(".extra");
            const element = document.createElement("p");
            element.classList.add("distance");
            element.textContent = `Distanza: ${distance.toFixed(2)} km`;
            extraSection.append(element);
        });
        
        // Ordina il carte in base a distanza e apertura
        const compare = (e1, e2) => {
            if (e1.dataset.open == e2.dataset.open)
            return e1.dataset.distance - e2.dataset.distance
            return e1.dataset.open - e2.dataset.open
        }
        
        const auleClean = Array.prototype.slice.call(aule, 0);
        auleClean.sort(compare);
        
        // Rimpiazza la lista vecchia
        const oldRoot = document.querySelector(".cards");
        const root = oldRoot.cloneNode(false);
        auleClean.forEach(it => root.appendChild(it));
        oldRoot.parentNode.replaceChild(root, oldRoot);
    });
}

if ("geolocation" in navigator) {
    const section = document.getElementById("aule");
    const button = document.createElement("button");
    button.id = "order";
    button.classList.add("btn", "btn-primary");
    button.addEventListener('click', sort);
    button.innerText = "Ordina in base alla distanza";
    section.children[1].appendChild(button);
}
