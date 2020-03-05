/**
 * Permet de rajouter la navigation tactile pour le carousel
 */
class CarouselTouchPlugin{

    /**
     *
     * @param {Carousel} carousel
     */
    constructor(carousel){
        carousel.container.addEventListener("dragstart", (e) => e.preventDefault());
        carousel.container.addEventListener("mousedown", this.startDrag.bind(this));
        carousel.container.addEventListener("touchstart", this.startDrag.bind(this));
        window.addEventListener("mousemove", this.drag.bind(this));
        window.addEventListener("touchmove", this.drag.bind(this));
        window.addEventListener("touchend", this.endDrag.bind(this));
        window.addEventListener("mouseup", this.endDrag.bind(this));
        window.addEventListener("touchcancel", this.endDrag.bind(this));
        this.carousel = carousel;
    }

    /**
     * Démarre le déplacement au touché
     * @param {MouseEvent | TouchEvent} e
     */
    startDrag(e){
        if (e.touches){
            if (e.touches.length > 1){
                return
            } else {
                e = e.touches[0]
            }
        }
        this.origin = {x: e.screenX, y: e.screenY};
        this.width = this.carousel.containerWidth;
        this.carousel.disableTransition();
    }

    /**
     *
     * Déplacement
     * @param {MouseEvent | TouchEvent} e
     */
    drag(e){
        if (this.origin){
            let point = e.touches ? e.touches[0] : e;
            let translate = {x: point.screenX - this.origin.x, y: point.screenY - this.origin.y};
            if (e.touches && Math.abs(translate.x) > Math.abs(translate.y)){
                e.preventDefault();
                e.stopPropagation();
            }
            let baseTranslate = this.carousel.currentItem * -100 / this.carousel.items.length;
            this.lastTranslate = translate;
            this.carousel.translate(baseTranslate + 100 * translate.x / this.width);
        }
    }

    /**
     *
     * Fin du déplacement
     * @param {MouseEvent | TouchEvent} e
     */
    endDrag(e){
        if (this.origin && this.lastTranslate){
            /* relance la transition */
            this.carousel.enableTransition();
            /* Math.abs = retourne la valeur absolue */
            if (Math.abs(this.lastTranslate.x / this.carousel.carouselWidth) > 0.2){
                if (this.lastTranslate.x < 0){
                    this.carousel.next();
                } else {
                    this.carousel.prev();
                }
            } else {
                this.carousel.gotoItem(this.carousel.carouselWidth)
            }
        }
        this.origin = null;
    }
}

/*================== CAROUSEL =================*/
class Carousel{

    /**
     * this callback type is called `requestCallBack` and is displayed as a global symbol.
     *
     * @callback moveCallBacks
     * @param {number} index
     */


    /**
     *
     * @param {HTMLElement} element
     * @param {Object} options
     * @param {Object} [options.slidesToScroll=1] Nombre d'éléments à faire défiler
     * @param {Object} [options.slidesVisible=1] Nombre d'éléments visible dans un slide
     * @param {boolean} [options.loop=false] Doit-t-on boucler en fin de carousel
     * @param {boolean} [options.infinite=false]
     * @param {boolean} [options.pagination=false]
     * @param {boolean} [options.navigation=true]
     * @param {boolean} [options.autoPlay=false]
     */
    constructor(element, options = {}){
        this.element = element; // Sauvegarde l'élément dans une variable "element"
        this.options = Object.assign({}, { // Création de la propriété "options" assigné à l'objet et les valeurs par default
            /* les Propriétés par défault */
            slidesToScroll: 1,
            slidesVisible: 1,
            loop: false,
            pagination: false,
            navigation: true,
            infinite: false,
            autoPlay: false,
            nextAndPrev: false,
            time: 1500,
        }, options);

        /**
         *
         * L'auto play
         */
        this.isPlayed = this.options.autoPlay;
        this.isPlayed ? this.options.autoPlay = true : this.options.autoPlay = false;
        if (this.options.autoPlay === true && this.options.infinite === true){
            this.interval = window.setInterval(() => {
                this.playSlide = this.currentItem;
                this.gotoItem(this.playSlide + 1, true);
                this.playSlide++;
            }, this.options.time)
        }else if(this.options.autoPlay === false){
            clearInterval(this.interval)
        }


        if (this.options.loop && this.options.infinite){
            throw new Error("Un carousel ne peut être a la fois en boucle et en infinie")
        }
        let children = [].slice.call(element.children); // Conserve les éléments enfant dans un tableau
        this.isMobile = false; // Est-on sur mobile?
        /* le premier element visible du slider */
        this.currentItem = 0;
        /* sauvegarde les call back dans une instance */
        this.moveCallBacks = [];
        /* offset */
        this.offset = 0;

        /*================ Modification du DOM ===============*/

        this.root = this.createDivWithClass("carousel"); // Création d'une DIV avec la class carousel
        this.container = this.createDivWithClass("carousel__container");
        this.root.setAttribute('tabindex', '0');
        /* rajouter le container dans la div root */
        this.root.appendChild(this.container); //Insère la DIV carousel__container dans la DIV carousel
        this.element.appendChild(this.root); // Crée une DIV avec avec l'élément "root"
        this.items = children.map((child) => { // Utilisation de la méthode forEach sur mes enfants
            let item = this.createDivWithClass("carousel__item"); // Création de mes container parents avec la méthode createDivWithClass
            item.appendChild(child); // On rajoute les enfants dans les "items"
            return item;
        });
        /**
         * Infinite
         */
        if (this.options.infinite){
            this.offset = this.options.slidesVisible + this.options.slidesToScroll; // On rajoute les "items" hors champs
            if(this.offset > children.length){
                console.error("Vous n'avez pas assez d'élément dans le carousel", element);
                throw new Error("Vérifier le nombre d'élément dans le carousel");
            }
            /*
            "map" va clone les item " cloneNode(true) " va cloner les enfants
             */
            this.items = [
                /* ajoute les 5 dernier item */
                ...this.items.slice(this.items.length - (this.offset)).map(item => item.cloneNode(true)),
                /* la liste des item */
                ...this.items,
                /* ajoute les 5 premier item */
                ...this.items.slice(0,this.offset).map(item => item.cloneNode(true)),
            ];
            this.gotoItem(this.offset,false);
        }

        /* ajoute les item dans le container */
        this.items.forEach(item => this.container.appendChild(item));
        this.setStyle();
        if (this.options.navigation){
            this.createNavigation();
        }
        if (this.options.pagination){
            this.createPagination();
        }

        /*==================== EVENT =================*/

        this.moveCallBacks.forEach(cb => cb(this.currentItem));
        this.onWindowResize(); // Appel de la méthode pour redimensionnement sur mobile
        window.addEventListener('resize', this.onWindowResize.bind(this)); // Vérifie le redimensionnement de la fenetre pour le responsive du carousel
        this.root.addEventListener('keyup', (e) => { // Ajoute un evenement au relachement des touches du clavier
            if (e.key === "ArrowRight" || e.key === "Right"){ // Définie la touche flêche de droite
                this.next(); // Lui passe la méthode next
            }else if(e.key === "ArrowLeft" || e.key === "Left"){ // Définie la touche flêche gauche
                this.prev(); // Lui passe la méthode prev
            }
        });

        /* si infinite */
        if (this.options.infinite){
            this.container.addEventListener("transitionend", this.resetInfinite.bind(this));
        }

        /**
         * introduction du Touch tactile
         */
        new CarouselTouchPlugin(this);
    }



    /*========== GETTERS ========*/

    /**
     * Nombre d'éléments à faire défiler
     * @returns {number}
     */
    get slidesToScroll(){
        /* si on est sur mobile on retourne 1 */
        return this.isMobile ? 1 : this.options.slidesToScroll; // Si le support est un mobile alors on retourne 1 ou sinon le paramètre slidesToScroll
    }

    /**
     * Nombre d'éléments à afficher
     * @return {number}
     */
    get slidesVisible(){
        return this.isMobile ? 1 : this.options.slidesVisible; // Si le support est un mobile alors on retourne 1 ou sinon le paramètre slidesVisible
    }

    /**
     *
     * @returns {number}
     */
    get containerWidth(){
        /* retourne la valeur du container qui contient tout les item */
        return this.container.offsetWidth;
    }

    /**
     * @returns {number}
     */
    get carouselWidth(){
        return this.root.offsetWidth;
    }

    /**
     * Applique les bonnes dimensions aux éléments du carousel
     */
    setStyle(){
        let ratio = this.items.length / this.slidesVisible; // Nous donne le nombre d'éléments dans le slide divisé par le nombre d'éléments visible voulu
        this.container.style.width = (ratio * 100) + "%"; // Applique a mon container une largeur égale au "ratio" x 100 en %
        this.items.forEach(item => item.style.width = ((100 / this.slidesVisible) / ratio) + "%"); // régle le style des items :l'élément visible divisé par le ratio sur 100 et on ajoute le pourcentage
    }

    /**
     * Méthode de création de la navigation dans le DOM
     */
    createNavigation(){
        if (this.options.nextAndPrev === true) {
            let nextButton = this.createIconWithClass("fa fa-arrow-right"); // Crée le button next
            let prevButton = this.createIconWithClass("fa fa-arrow-left"); // Crée le button prev
            this.root.appendChild(nextButton); // Ajoute le button next dans le carousel
            this.root.appendChild(prevButton); // Ajoute le button prev dans le carousel
            nextButton.addEventListener("click", this.next.bind(this)); // Ajoute un evenement sur le button, au click et effectue la méthode next
            prevButton.addEventListener("click", this.prev.bind(this)); // Ajoute un evenement sur le button, au click et effectue la méthode prev
            if (this.options.loop === true){
                return
            }
            // Appel de la méthode onMove en paramètre
            this.onMove(index => {
                if (index === 0){ // Si l"index est égal à 0
                    prevButton.classList.add('carousel__prev--hidden') // Rajoute la class hidden
                }else{
                    prevButton.classList.remove('carousel__prev--hidden'); // Supprime la class hidden
                }
                // Supprime ou affiche le button suivant
                if (this.items[this.currentItem + this.slidesVisible] === undefined){
                    nextButton.classList.add('carousel__next--hidden')
                }else{
                    nextButton.classList.remove('carousel__next--hidden');
                }
            })
        }
    }

    /**
     * Crée la pagination dans le DOM ( les petit rond )
     */
    createPagination(){
        let pagination = this.createDivWithClass("carousel__pagination");
        let buttons = [];
        this.root.appendChild(pagination);
        for (let i =0; i < (this.items.length - 2 * this.offset); i = i + this.options.slidesToScroll){
            let button = this.createDivWithClass("carousel__pagination__button");
            button.addEventListener('click', () => {
                this.gotoItem(i + this.offset);
            });
            pagination.appendChild(button);
            buttons.push(button);
        }
        this.onMove(index => {
            let count = this.items.length - 2 * this.offset;
            /* renvoie un chiffre fixe */
            let activeButton = buttons[Math.floor(((index - this.offset) % count) / this.options.slidesToScroll)];
            if (activeButton){
                buttons.forEach(button => button.classList.remove("carousel__pagination__button--active"))
                activeButton.classList.add("carousel__pagination__button--active")
            }
        })
    }

    /* ANIMATION 3d */
    translate(percent){
        this.container.style.transform = `translate3d(${percent}%,0,0)`; // Applique l'animation translated3d avec X,Y,Z en paramètre
    }

    next(){
        this.gotoItem(this.currentItem + this.slidesToScroll); // Appel de la méthode gotoItem
    }

    prev(){
        this.gotoItem(this.currentItem - this.slidesToScroll); // Appel de la méthode gotoItem
    }

    /**
     * Déplace le carousel vers l'éléments ciblé
     * @param {number} index
     * @param {boolean} [animation=true]
     */
    gotoItem(index, animation = true){
        if (index < 0){ // Si l'index est inférieur à 0 on revient en arrière
            if (this.options.loop){ // Index égal le nombre d'éléments moins le nombres d'éléments visibles
                index = this.items.length - this.slidesVisible;
            }else{
                return;
            }
            // Si l'index est supérieur ou égal aux nombres d'élément, ou currentItem + le nombres de slides visibles sont undefined et si l'index est supérieur à currentItem
        }else if (index >= this.items.length || (this.items[this.currentItem + this.slidesVisible] === undefined && index > this.currentItem)){
            if (this.options.loop){
                index = 0; // Alors l'index revient à zero
            }else{
                return;
            }
        }
        // Animation de slide vers l'élément
        let translateX = index * -100 / this.items.length;
        if (animation === false){
            this.disableTransition();
        }
        this.translate(translateX);
        this.container.offsetHeight; // force repaint
        if (animation === false ){
            this.enableTransition();
        }
        this.currentItem = index; // Définie l'élément comme l'index
        this.moveCallBacks.forEach(cb => cb(index)) // Appel des callbacks les uns après les autres avec l'index courant en paramètre
    }

    /**
     * Deplace le container pour donner l'impression d'un slide infinie
     */
    resetInfinite(){
        if (this.currentItem <= this.options.slidesToScroll){
            /* rajoute le nombre d'item */
            this.gotoItem(this.currentItem + this.items.length - 2 * this.offset, false)
        }else if(this.currentItem >= this.items.length - this.offset){
            /* retire le nombre d'item */
            this.gotoItem(this.currentItem - (this.items.length - 2 * this.offset), false)
        }
    }

    /**
     *
     * @param {moveCallBacks} cb
     */
    onMove(cb){
        this.moveCallBacks.push(cb); // Ajoute les callbacks dans mon instance tableau
    }

    /**
     * Méthode pour le responsive du carousel
     */
    onWindowResize(){
        let mobile = innerWidth < 800; // Déclare la variable mobile qui cible la fenetre avec une largeur inferieur à 800px
        if (mobile !== this.isMobile){ // Si la valeur de mobile est differente de celle de this.isMobile
            this.isMobile = mobile; // Change la valeur de la propriété de l'instance
            this.setStyle(); // Applique le style
            this.moveCallBacks.forEach(cb => cb(this.currentItem)); // Rappel des callbacks avec l'item courant
        }
    }

    /* cree une div avec une class */
    /**
     *
     * @param {string} className
     * @returns {HTMLElement}
     */
    createDivWithClass(className){
        /* creation d'une div */
        let div = document.createElement("div"); // Ajoute un élément HTML de type DIV
        /* attribut une class a la div */
        div.setAttribute("class", className); // Lui ajoute l'attribut " CLASS "
        return div
    }

    /**
     *
     * @param {string} className
     * @returns {HTMLElement}
     */
    createIconWithClass(className){
        /* creation d'une balise <i></i> */
        let i = document.createElement("i"); // Ajoute un élément HTML de type <i>
        i.setAttribute("class", className); // Lui ajoute l'attribut " CLASS "
        return i;
    }

    disableTransition(){
        this.container.style.transition = "none";
    }

    enableTransition(){
        this.container.style.transition = '';
    }




}

/*==================== PARALLAX ==============================*/
class Parallax {

    constructor (id, option) {
        this.element = id;
        this.option = option;
        const parallax = document.getElementById(this.element);
        window.addEventListener("scroll", () => {
            let offset = window.pageYOffset;
            parallax.style.backgroundPositionY = offset * this.option + "px";
        });
    }
}


/*================ Gere le chargement de script async ======================*/

let onReady = () => {

    new Parallax("graphic__parallax", 0.7);
    new Parallax("testimonial__parallax", 1.1);
    new Parallax("graphic__parallax__about", 0.7);

    /*============ CAROUSEL =================*/
    new Carousel(document.querySelector("#carousel1"), {
        /* nombre d'elements a scroller */
        slidesToScroll: 1,
        /* nombre d'elements visible */
        slidesVisible: 1,
        loop: false,
        pagination: true,
        infinite: true,
        autoPlay: true,
        time: 3000,
    });

    new Carousel(document.querySelector("#carousel2"), {
        /* nombre d'elements a scroller */
        slidesToScroll: 1,
        /* nombre d'elements visible */
        slidesVisible: 4,
        loop: false,
        pagination: false,
        infinite: true,
        autoPlay: true,
        time: 2000
    });

    new Carousel(document.querySelector("#carousel3"), {
        /* nombre d'elements a scroller */
        slidesToScroll: 1,
        /* nombre d'elements visible */
        slidesVisible: 3,
        loop: false,
        pagination: false,
        infinite: true,
        autoPlay: true,
        nextAndPrev: false,
        time: 2000,
    });

    new Carousel(document.querySelector("#carousel4"), {
        /* nombre d'elements a scroller */
        slidesToScroll: 1,
        /* nombre d'elements visible */
        slidesVisible: 6,
        loop: false,
        pagination: false,
        infinite: true,
        autoPlay: true,
        nextAndPrev: false,
        time: 2000
    });
};

let onBlocking = () => {
    new Carousel(document.querySelector("#carousel6"), {
        /* nombre d'elements a scroller */
        slidesToScroll: 1,
        /* nombre d'elements visible */
        slidesVisible: 6,
        loop: false,
        pagination: false,
        infinite: true,
        autoPlay: true,
        nextAndPrev: false,
        time: 2000
    });
};



/**
 * Gere le chargement de script async
 */
if (document.readyState !== "loading"){
    onReady();
    onBlocking();
}


document.addEventListener("DOMContentLoaded",onReady);
document.addEventListener("DOMContentLoaded",onBlocking);