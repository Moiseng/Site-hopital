<?php

$title = "Nous-Contacter";

?>

<section class="contact_page" id="contact_page__parallax">
    <h2 class="contact__title">
        Nous Contacter
    </h2>
</section>

<section class="contact__types">
    <h2>Avez vous des Questions?</h2>
    <div class="contact__types__content">
        <div>
            <i class="fas fa-phone-alt"></i>
            <h4>Appelez-Nous</h4>
            <p>Phone: +262 695 2601</p>
        </div>
        <div>
            <i class="fas fa-map-marker-alt"></i>
            <h4>Adresse</h4>
            <p>121 King Street, Australia</p>
        </div>
        <div>
            <i class="fas fa-envelope"></i>
            <h4>Email</h4>
            <p>you@yourdomain.com</p>
        </div>
    </div>
</section>

<section class="contact__forms">
    <div class="contact__forms__contents">
        <div class="contact__form__top">
            <h3>Vous souhaitez discuter?</h3>
            <div class="separator__form"></div>
            <form action="#" method="post" class="contact__form__container">
                <div class="form__group">
                    <label for="name">Nom *</label>
                    <input type="text" class="form__control" id="name" name="name" placeholder="Entrez votre nom">
                </div>
                <div class="form__group">
                    <label for="email">Email *</label>
                    <input type="email" class="form__control" id="email" name="email" placeholder="Entrez l'adresse email">
                </div>
                <div class="form__group">
                    <label for="subject">Sujet *</label>
                    <input type="text" class="form__control" id="subject" name="subject" placeholder="Sujet">
                </div>
                <div class="form__group">
                    <label for="phone">Téléphone</label>
                    <input type="number" class="form__control" id="phone" name="phone" placeholder="+33 000 000 00">
                </div>
                <div class="form__group form__message">
                    <label for="message">Message</label>
                    <textarea name="message" class="message" id="message" placeholder="Entrez le message"></textarea>
                </div>
                <button type="submit">Envoyer le message</button>
            </form>
        </div>
        <div class="contact__form__map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.838357620283!2d144.9535833152772!3d-37.81725497975183!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4dd5a05d97%3A0x3e64f855a564844d!2s121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20Australie!5e0!3m2!1sfr!2sfr!4v1583360101168!5m2!1sfr!2sfr" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
    </div>
</section>