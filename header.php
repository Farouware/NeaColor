<div class="site-navbar-top bg-dark">

                <div class="container-fluid site-top-icons">
                    <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
                        <div class="container">
                            <img  src="images/logo.jpg" width="200">
                            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="d-flex justify-content-end">
                                <div id="MenuNavegacion" class="collapse navbar-collapse">
                                    
                                    <ul class="navbar-nav ms-3">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">

                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Mis Datos</a></li>
                                                <li><a class="dropdown-item" href="{% url 'logout' %}">Cerrar Sesion</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{% url 'historial' %}">Historial</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{% url 'cart:summary' %}">Carrito</a></li>
                                        <li>
                                            <li><a href="{% url 'login' %}"><span><i
                                                            class="fas fa-sign-in-alt"></i></span>Iniciar Sesion</a></li>
                                            <li><a href="{% url 'registroUsuario' %}">o Registrarse</a></li>
                                     
                                        </li>
                                        <li>
                                            <a href="{% url 'cart:summary' %}" class="nav-link">
                                                <span><i class="fas fa-shopping-cart"></i></span>
                                                <span class="count"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

            </div>