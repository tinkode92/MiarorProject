<div class="copyright">
    <p>copyright 2022 <a href="#">Yanis Bekrarchouche</a> IIM RESTART. Tous droits reservé</p>
</div>
<!-- Ce script permet de fixer la topbar en haut, au scroll -->
<script type="text/javascript">
    window.addEventListener('scroll', function(){
        const header =document.querySelector('header');
        header.classList.toggle("sticky", window.scrollY > 0 );
    });

    function toggleMenu(){
        const tmenuToggle = document.querySelector('.menuToggle');
        const navbar = document.querySelector('.navbar');
        navbar.classList.toggle('active');
        menuToggle.classList.toggle('active');
    }
</script>