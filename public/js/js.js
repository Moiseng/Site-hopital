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


/*=============== PARALLAX ================*/
new Parallax("graphic__parallax", 0.7);
new Parallax("testimonial__parallax", 1.1);