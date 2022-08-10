<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Regulable Appointment Calendar</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>

<!--#region Animation Page  -->

<?php
    include "db_connect.php";

    /** Ayarlanmış dolu randevuları çek */
    $doluRandevular = $data->prepare("SELECT * FROM dolu_randevular where id=?");
    $doluRandevular->execute(array(1));
    $fetchRandevular = $doluRandevular->fetch();

    if ($doluRandevular->rowCount()){
        $fetchDates = $fetchRandevular['dates'];
        $fetchDays = $fetchRandevular['days'];
    }else{
        $fetchDates = "";
        $fetchDays = "";
    }


    $doluGunler = array();
    $doluSaatler = array();

    /** Dolu tarihleri belirleme */
    $explodeFetchDates = explode("*",$fetchDates);
    array_pop($explodeFetchDates);
    for ($i=0; $i<count($explodeFetchDates); $i++){
        array_push($doluSaatler,$explodeFetchDates[$i]);
    }

    /** Dolu günleri belirleme */
    $doluGunler = explode("-",$fetchDays);

    function gunAdiBul($gelenDeger){
        switch ($gelenDeger){
            case 1 : return "Pazartesi"; break;
            case 2 : return "Salı"; break;
            case 3 : return "Çarşamba"; break;
            case 4 : return "Perşembe"; break;
            case 5 : return "Cuma"; break;
            case 6 : return "Cumartesi"; break;
            case 0 : return "Pazar"; break;
        }
    }

    /** Randevuları çek ve diziye atıp sorgula */
    $danisanRandevulari = $data->prepare("SELECT * FROM randevular");
    $danisanRandevulari->execute();
    $fetchDanisanRandevulari = $danisanRandevulari->fetchAll(PDO::FETCH_ASSOC);

    $gelenTarih = array();

    foreach($fetchDanisanRandevulari as $writeDanisanRandevulari){
        array_push($gelenTarih,$writeDanisanRandevulari['date']);
    }
    date_default_timezone_set('Europe/Istanbul');
    $gununTarihi = date('d.m.Y');
    $gunDegeri =  date('w');

    $sabahBaslangicSaati = 9;
    $aksamBitisSaati = 19;

?>

<div class="calendar_boxes">
    <?php
    for ($gun = $gunDegeri; $gun < $gunDegeri + 5; $gun++){
        $str = strtotime($gununTarihi);
        $tarihinGunDegeri =  date('w',$str);
        ?>
        <div class="calendar_box">
            <div class="date_calendar">
                <?php echo $gununTarihi; ?>
                <p class="m-0 day_name">
                    <?php
                    echo gunAdiBul($tarihinGunDegeri);
                    ?>
                </p>
            </div>
            <div class="date_clocks">
                <?php
                for ($saat = $sabahBaslangicSaati; $saat<$aksamBitisSaati+1; $saat++ ){
                    $saat < 10 ? $saat = '0'.$saat : $saat = $saat;  // 09 gibi saatleri algılaması için
                    if (in_array($gununTarihi . '-' . $saat .  ':00',$gelenTarih) || in_array($gununTarihi . '-' . $saat .  ':00',$doluSaatler) || in_array($tarihinGunDegeri,$doluGunler)){
                        ?>
                        <div class="clock">
                            <input required type="radio" id="<?php echo $gununTarihi . '-' . $saat . ':00';  ?>" name="date" class="d-none" value="<?php echo $gununTarihi. '-' .$saat . ':00'; ?>">
                            <label title="Dolu" class="active_clock" for=""><?php echo $saat; ?>:00</label>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="clock">
                            <input required type="radio" id="<?php echo $gununTarihi . '-' . $saat . ':00';  ?>" name="date" class="d-none" value="<?php echo $gununTarihi. '-' .$saat . ':00'; ?>">
                            <label class="" for="<?php echo $gununTarihi . '-' . $saat . ':00';  ?>"><?php echo $saat; ?>:00</label>
                        </div>
                        <?php
                    }

                    if($saat != $aksamBitisSaati){
                        if (in_array($gununTarihi . '-' . $saat .  ':30',$gelenTarih) || in_array($gununTarihi . '-' . $saat .  ':30',$doluSaatler ) || in_array($tarihinGunDegeri,$doluGunler)){
                            ?>
                            <div class="clock">
                                <input required type="radio" id="<?php echo $gununTarihi . '-' . $saat . ':30';  ?>" name="date" class="d-none" value="<?php echo $gununTarihi. '-' .$saat . ':30'; ?>">
                                <label title="Dolu" class="active_clock" for=""><?php echo $saat; ?>:30</label>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="clock">
                                <input required type="radio" id="<?php echo $gununTarihi . '-' . $saat . ':30';  ?>" name="date" class="d-none" value="<?php echo $gununTarihi. '-' .$saat . ':30'; ?>">
                                <label class="" for="<?php echo $gununTarihi . '-' . $saat . ':30';  ?>"><?php echo $saat; ?>:30</label>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <?php
            $sonrakiGun = strtotime('1 day',strtotime($gununTarihi));
            $gununTarihi =  date("d.m.Y",$sonrakiGun);
            ?>
        </div>
        <?php
    }
    ?>
</div>

<!--#endregion-->

</body>
</html>
