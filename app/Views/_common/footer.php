            <li class="list-unstyled text-end">desenvolvido por: clovis sardinha -2025</li>
            </div> <!-- Fechando a row -->
            </div> <!-- Fechando container -->
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
            <script src="/assets/js/familia.js"></script>
            <script src="/assets/js/voluntario.js"></script>
            <script src="/assets/js/doador.js"></script>
            <script src="/assets/js/evento.js"></script>
            <script src="/assets/jquery/jquery.min.js"></script>
            <script src="/assets/js/bootstrap.bundle.min.js"></script>
            <script src="/assets/jquery/jquery.mask.min.js"></script>
            <script src="/assets/jquery/chart.umd.js"></script>
            <script src="assets/js/dashboard.js"></script>
            <script>
              $(document).ready(function() {
                // Máscara para telefone
                $("#telefone").mask("(00) 00000-0000");
                $("#telefone1").mask("(00) 00000-0000");
                $("#CEP").mask("00.000-000");
                $("#RG").mask("00.000.000-0");
                $("#CPF").mask("000.000.000-00");
                // Máscara para valores em real
                $("#valor").mask("00.000,00", {
                  reverse: true
                });
                //mascara para quantidade
                $("#quantidade").mask("00.000,00", {
                  reverse: true
                });
                $("#salario").mask("00.000,00", {
                  reverse: true
                });
              });
            </script>
            </body>

            </html>