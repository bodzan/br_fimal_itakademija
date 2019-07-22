<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="wrapper">
            <h1></h1>
            <nav class="clearfix">
                <ul>
                    <li><a href="index.php">Unesi polisu</a></li>
                    <li><a href="policies.php">Policies</a></li>
                </ul>
            </nav>

            <cont>
                <h2>Prijava za putno osiguranje</h2>
                <form action="record_policy.php" method="post">
                    <label>Ime i prezime nosioca osiguranja: <span class="important">*</span></label><br>
                    <input type="text" name="holder_name" placeholder="Ime i prezime nosioca osiguranja" size="30"><br><br>


                    <label>Datum rođenja: <span class="important">*</span></label><br>
                    <input type="date" name="dob" placeholder="Datum rođenja"><br><br>

                    <label>Broj pasoša: <span class="important">*</span></label><br>
                    <input type="text" name="passport" placeholder="Broj pasoša" size="30"><br><br>

                    <label>Broj telefona:</label><br>
                    <input type="text" name="telephone" placeholder="Broj telefona"><br><br>


                    <label>E-mail adresa: <span class="important">*</span></label><br>
                    <input type="email" name="email" placeholder="Email adresa" size="30"><br><br>


                    <h3>Datumi putovanja</h3>
                    <span class="dates">
                        <label>Dan početka putovanja: <span class="important">*</span></label><br>
                        <input type="date" name="start_date" placeholder="Datum početka putovanja"><br><br>
                    </span>

                    <span class="dates">
                        <label>Dan završetka putovanja: <span class="important">*</span></label><br>
                        <input type="date" name="end_date" placeholder="Datum završetka putovanja"><br><br>
                    </span>


                    <div class="groups">
                        Vrsta putnog osiguranja:
                        <select name="option" id="option">
                            <option value="ind">Individualno osiguranje</option>
                            <option value="grp">Grupno</option>
                        </select><br><br>

                        <div id="group">

                            <label>Ime i prezime dodatnog osiguranika <span class="important">*</span></label><br>
                            <input type="text" name="member_name[]" placeholder="Ime i prezime dodatnog osiguranika" size="30"><br><br>

                            <label>Datum rođenja <span class="important">*</span></label><br>
                            <input type="date" name="member_dob[]" placeholder="Datum rodjenja"><br><br>

                            <label>Broj pasoša <span class="important">*</span></label><br>
                            <input type="text" name="member_passport[]" placeholder="Broj pasoša" size="30"><br><br>


                            <div id="extras"></div>

                        </div>
                        <div id="more"></div>
                    </div>

                    <a href="#" id="open_more" onclick="return false;">Dodaj još osiguranika</a>
                    <br>
                    <br>

                    <input type="submit" name="submit" value="Snimi">
                </form>
            </cont>
        </div>

        <script type="text/javascript">

            let option = document.getElementById('option');
            option.addEventListener('change', () => {

                if (option.value === 'grp') {
                    let group = document.getElementById('group');
                    group.style.display = 'block';

                    let open_more = document.getElementById('open_more');
                    open_more.style.display = 'block';
                }



                let more_html = `<br>

                            <label>Ime i prezime dodatnog osiguranika <span class="important">*</span></label><br>
                            <input type="text" name="member_name[]" placeholder="Ime i prezime dodatnog osiguranika" size="30"><br><br>

                            <label>Datum rođenja <span class="important">*</span></label><br>
                            <input type="date" name="member_dob[]" placeholder="Datum rodjenja"><br><br>

                            <label>Broj pasoša <span class="important">*</span></label><br>
                            <input type="text" name="member_passport[]" placeholder="Broj pasoša" size="30"><br><br>
                `;

                let open_more = document.getElementById('open_more');

                open_more.addEventListener('click', (e) => {

                    // open_more.style.display = 'none';


                    let extras = document.getElementById('extras');


                    extras.insertAdjacentHTML('beforeend', more_html);
                });

            });

        </script>


    </body>
</html>
