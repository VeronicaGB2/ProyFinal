<!--footer-->
<footer class="kilimanjaro_area">
    <!-- Top Footer Area Start -->
    <div class="foo_top_header_one section_padding_100_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="kilimanjaro_part m-top-15">
                        <h5>Redes Sociales en donde nos puedes encontrar</h5>
                        <ul class="kilimanjaro_social_links">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
                            <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i> YouTube</a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="kilimanjaro_part m-top-15">
                        <h5>Important Links</h5>
                        <ul class="kilimanjaro_links">
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Terminos & Condiciones</a></li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>ayuda & soporte</a></li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Politicas de Privacidad</a></li>
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Comunidad</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="kilimanjaro_part">
                        <h5>Latest News</h5>
                        <div class="kilimanjaro_blog_area">
                            <div class="kilimanjaro_thumb">
                                <img class="img-fluid" src="https://www.wradio.com.co/resizer/cfeoyTD9YahBRwYViwi3Sh1MWAU=/650x488/filters:quality(70)/cloudfront-us-east-1.images.arcpublishing.com/prisaradioco/E7MNWHCDDNHHVACI5WRESDIXXE.jpg" alt="">
                            </div>
                            <a href="">Your Blog Title Goes Here</a>
                            <p class="kilimanjaro_date">17 sep 2023</p>
                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="kilimanjaro_part">
                        <h5>Contactos</h5>
                        <div class="kilimanjaro_single_contact_info">
                            <h5>Phone:</h5>
                            <p>+255 789 54 50 40 <br> +2255 766 90 94 00</p>
                        </div>
                        <div class="kilimanjaro_single_contact_info">
                            <h5>Email:</h5>
                            <p>support@webblogoverflow.com <br> garciaveronica341@gmail.com</p>
                        </div>
                    </div>
                    <div class="kilimanjaro_part">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom Area Start -->
    <div class=" kilimanjaro_bottom_header_one section_padding_50 text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>© All Rights Reserved by <a href="#"><i class="fa fa-love"></i></a></p>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {

            function updateCartCount() {
                $.ajax({
                    type: "GET",
                    url: "../controllers/carritoController_aux.php",
                    success: function(response) {
                        console.log(response);
                        $(".cart-count").text(response);
                    }
                });
            }

            updateCartCount();

            $("form[id^='productForm']").on("submit", function(event) {
                event.preventDefault();
                var action = "updateProduct";
                var formData = $(this).serialize();

                $.ajax({
                    method: "POST",
                    url: "../controllers/carritoController.php",
                    data: formData,
                    success: function(data) {


                    }
                });
                $.ajax({
                    method: "POST",
                    url: "../controllers/mainController.php",
                    data: {
                        action: action,
                        data:formData,
                    },
                    success: function(response) {
                        console.log(response); // Imprime la respuesta en la consola
                        Swal.fire(
                            'Producto agregado con éxito!',
                            '',
                            'success'
                        );
                    },
                    error: function(error) {
                        console.log(error); // Imprime errores en la consola
                    }
                });


                updateCartCount();
            });
        });
    </script>


</footer>