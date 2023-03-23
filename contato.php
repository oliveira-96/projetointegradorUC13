<div class="row divc content" id="contatti">
    <div class="container mt-5">
        <div style="width: 83%;" class="row" style="height:450px;">
            <div class="col-md-6 maps" style="margin-top: 30px;">
                <iframe src="https://www.google.com/maps/d/embed?mid=1S9s5fa4SdqVNSUbnbMuSoqHVil4&hl=pt-BR&ehbc=2E312F"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
                <form class="form-horizontal" method="post" action="SalvarMensagemBanco.php">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Digite para nós:</legend>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="assunto">Assunto:</label>
                            <div class="col-md-8">
                                <input id="assunto" name="assunto" type="text" placeholder="assunto"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <!-- Textarea -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textarea">Texto:</label>
                            <div class="col-md-8">
                                <textarea class="form-control rounded-0" id="mensagem"></textarea>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nome">Nome:</label>
                            <div class="col-md-8">
                                <input id="nome" name="nome" type="text" placeholder="nome"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">E-mail:</label>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="email"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="telefone">Telefone:</label>
                            <div class="col-md-8">
                                <input id="telefone" name="telefone" type="text" placeholder="telefone"
                                    class="form-control input-md">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="enviar"></label>
                            <div class="col-md-4">
                                <button id="enviar" name="enviar" class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <div class="text-white" style="margin-top:60px;">
                    <h2 class="text-uppercase mt-4 font-weight-bold">Onde estamos:</h2>
                    <i class="fas fa-globe mt-3"></i> Carazinho Rio Grande Do Sul<br>
                    <i class="fas fa-globe mt-3"></i> (54) 99663-5442<br>
                    <i class="fas fa-globe mt-3"></i> aaboutiquestore@gmail.com<br>
                </div>
            </div>
        </div>
    </div>
</div>