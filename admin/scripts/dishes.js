function fetchDishes() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "admin/ajax/get_dishes.php", true);
    xhr.onload = function() {
        if (this.status === 200) {
            let dishes = JSON.parse(this.responseText);
            console.log(`images/restaurant/${dish.image}`);

            let dishesContainer = document.getElementById('dishes-container');
            dishesContainer.innerHTML = '';

            dishes.forEach(dish => {
                let dishCard = `
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4 img-container">
                                    <img src="images/restaurant/${dish.image}" class="img-fluid rounded">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${dish.name}</h5>
                                        <p class="card-text">${dish.description}</p>
                                        <p class="card-text"><small class="text-muted">$${dish.price}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                dishesContainer.insertAdjacentHTML('beforeend', dishCard);
            });
        } else {
            console.error('Error fetching dishes:', this.status);
        }
    };
    xhr.send();
}

window.onload = function() {
    fetchDishes();
};

