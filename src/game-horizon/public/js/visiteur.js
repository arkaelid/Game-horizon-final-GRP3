document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.querySelector('.sidebar');
    const menuState = localStorage.getItem('menuState');

    // Désactiver temporairement les transitions
    sidebar.classList.add('no-transition');

    // Appliquer l'état sauvegardé du menu
    if (menuState === 'retracted') {
        sidebar.classList.add('active'); // Menu rétracté
    } else {
        sidebar.classList.remove('active'); // Menu déployé
    }

    // Forcer le rafraîchissement du style sans transition, puis la réactiver
    setTimeout(() => {
        sidebar.classList.remove('no-transition');
    }, 50); // Petit délai pour éviter toute animation visible
});

document.getElementById('burger').addEventListener('click', function () {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
    
    // Sauvegarder l'état du menu dans localStorage
    if (sidebar.classList.contains('active')) {
        localStorage.setItem('menuState', 'retracted'); // Menu rétracté
    } else {
        localStorage.setItem('menuState', 'expanded'); // Menu déployé
    }
});

document.addEventListener('DOMContentLoaded', function() {
    console.log("Script de hover GIF chargé");
    const gameCards = document.querySelectorAll('.card');

    gameCards.forEach(gameCard => {
        const img = gameCard.querySelector('.card-image');
        const originalSrc = img.src;
        const gifUrl = img.dataset.gif; // Nous utiliserons un attribut data-gif

        gameCard.addEventListener('mouseenter', function() {
            console.log("Hover détecté, GIF URL:", gifUrl);
            if (gifUrl && gifUrl !== "null" && gifUrl !== "") {
                console.log("Changement de l'image vers le GIF");
                img.src = gifUrl;
            }
        });

        gameCard.addEventListener('mouseleave', function() {
            console.log("Fin du hover, retour à l'image originale");
            img.src = originalSrc;
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const suggestionsContainer = document.getElementById('search-suggestions');
    let debounceTimer;

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const query = this.value.trim();
        
        if (query.length < 2) {
            suggestionsContainer.style.display = 'none';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`/api/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(suggestions => {
                    if (suggestions.length > 0) {
                        suggestionsContainer.innerHTML = suggestions.map(game => `
                            <div class="suggestion-item" data-game-id="${game.id_jeu}">
                                <img src="/img/${game.image_card}" alt="${game.nom_jeu}" class="suggestion-image">
                                <span class="suggestion-title">${game.nom_jeu}</span>
                            </div>
                        `).join('');
                        suggestionsContainer.style.display = 'block';

                        // Modifier le gestionnaire de clic pour rediriger vers la page du jeu
                        document.querySelectorAll('.suggestion-item').forEach(item => {
                            item.addEventListener('click', function() {
                                const gameId = this.dataset.gameId;
                                window.location.href = `/game/${gameId}`;
                            });
                        });
                    } else {
                        suggestionsContainer.style.display = 'none';
                    }
                });
        }, 300);
    });

    // Fermer les suggestions si on clique en dehors
    document.addEventListener('click', function(e) {
        if (!suggestionsContainer.contains(e.target) && e.target !== searchInput) {
            suggestionsContainer.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const sliderMain = document.querySelector('.slider-main');
    const prevButton = document.querySelector('.slider-button.prev');
    const nextButton = document.querySelector('.slider-button.next');
    const previewItems = document.querySelectorAll('.preview-item');
    const slides = document.querySelectorAll('.slide');
    
    let currentIndex = 0;
    const totalSlides = slides.length;

    function updateSlider(index) {
        document.querySelector('.slide.active').classList.remove('active');
        document.querySelector('.preview-item.active').classList.remove('active');
        
        slides[index].classList.add('active');
        previewItems[index].classList.add('active');
        currentIndex = index;
    }

    prevButton.addEventListener('click', () => {
        const newIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider(newIndex);
    });

    nextButton.addEventListener('click', () => {
        const newIndex = (currentIndex + 1) % totalSlides;
        updateSlider(newIndex);
    });

    previewItems.forEach(item => {
        item.addEventListener('click', () => {
            const index = parseInt(item.dataset.index);
            updateSlider(index);
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider-UCgames');
    const prevButton = document.querySelector('.slider-UCbutton.prev');
    const nextButton = document.querySelector('.slider-UCbutton.next');
    const cards = slider.querySelectorAll('.card');
    
    let currentIndex = 0;
    const cardsPerView = 3;
    const maxIndex = Math.max(0, cards.length - cardsPerView);

    // Masquer le bouton précédent au démarrage
    prevButton.style.opacity = '0.5';
    prevButton.style.cursor = 'not-allowed';

    function updateSliderPosition() {
        const cardWidth = cards[0].offsetWidth + 20; // 20px est le gap
        slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        
        // Mettre à jour l'état des boutons
        prevButton.style.opacity = currentIndex === 0 ? '0.5' : '1';
        prevButton.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';
        
        nextButton.style.opacity = currentIndex === maxIndex ? '0.5' : '1';
        nextButton.style.cursor = currentIndex === maxIndex ? 'not-allowed' : 'pointer';
    }

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateSliderPosition();
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider-NEWgames');
    const prevButton = document.querySelector('.slider-NEWbutton.prev');
    const nextButton = document.querySelector('.slider-NEWbutton.next');
    const cards = slider.querySelectorAll('.card');
    
    let currentIndex = 0;
    const cardsPerView = 3;
    const maxIndex = Math.max(0, cards.length - cardsPerView);

    // Masquer le bouton précédent au démarrage
    prevButton.style.opacity = '0.5';
    prevButton.style.cursor = 'not-allowed';

    function updateSliderPosition() {
        const cardWidth = cards[0].offsetWidth + 20; // 20px est le gap
        slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        
        // Mettre à jour l'état des boutons
        prevButton.style.opacity = currentIndex === 0 ? '0.5' : '1';
        prevButton.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';
        
        nextButton.style.opacity = currentIndex === maxIndex ? '0.5' : '1';
        nextButton.style.cursor = currentIndex === maxIndex ? 'not-allowed' : 'pointer';
    }

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateSliderPosition();
        }
    });
});