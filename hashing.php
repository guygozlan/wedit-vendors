<?php
  function VendorAreaHash ($english)
  {
    $ret = "חסר";
    switch ($english)
    {
      case 'empty':           $ret = "חסר";             break;
      case 'north':           $ret = "צפון";            break;
      case 'haifaAndKrayot':  $ret = "חיפה והקריות";    break;
      case 'sharon':          $ret = "שרון";            break;
      case 'center':          $ret = "מרכז";            break;
      case 'Rashlaz':         $ret = "רשלצ-גדרה";       break;
      case 'south':           $ret = "דרום";            break;
      case 'jerusalem':       $ret = "ירושלים";         break;
      case 'tlv':             $ret = "תל אביב";         break;
    }
    return ($ret);
  }

  function PriceRangeHash ($english)
  {
    $ret = "חסר";
    switch ($english)
    {
      case 'one':     $ret = "זול מאוד";    break;
      case 'two':     $ret = "בינוני-זול";  break;
      case 'three':   $ret = "בינוני-יקר";  break;
      case 'four':    $ret = "יקר מאוד";    break;
    }
    return ($ret);
  }

  function VendorKindHash($vendor)
  {
    $msg='';
    if ($vendor["IsGan"])         $msg = $msg . "גן אירועים <br/>";
    if ($vendor["IsOlam"])        $msg = $msg . "אולם<br/>";
    if ($vendor["IsPub"])         $msg = $msg . "פאב<br/>";
    if ($vendor["IsSmall"])       $msg = $msg . "אירועים קטנים<br/>";
    if ($vendor["IsHome"])        $msg = $msg . "בית<br/>";
    if ($vendor["IsResturant"])   $msg = $msg . "מסעדה<br/>";
    if ($vendor["IsNatureProd"])  $msg = $msg . "הפקה בטבע<br/>";
    if ($vendor["IsHistorical"])  $msg = $msg . "מקום היסטורי<br/>";
    if ($vendor["IsSinigog"])     $msg = $msg . "בית כנסת<br/>";
    if ($vendor["IsHotel"])       $msg = $msg . "מלון<br/>";
    if ($vendor["IsOpenGan"])     $msg = $msg . "גן אירועים פתוח </br>";
    return ($msg);
  }

  function VendorFeaturesHash($vendor)
  {
    $msg='';
    if ($vendor["IsSleepOver"])     $msg = $msg . "לינה במקום<br/>";
    if ($vendor["IsHagasha"])       $msg = $msg . "הגשה<br/>";
    if ($vendor["IsBofet"])         $msg = $msg . "בופה<br/>";
    if ($vendor["IsHupaOutside"])   $msg = $msg . "חופה בחוץ<br/>";
    if ($vendor["IsHupaInside"])    $msg = $msg . "חופה בפנים<br/>";
    if ($vendor["IsPool"])          $msg = $msg . "יש בריכה<br/>";
    if ($vendor["IsNature"])        $msg = $msg . "מקום בטבע<br/>";
    if ($vendor["PlaceOnly"])       $msg = $msg . "אופ להשכיר רק מקום<br/>";
    return ($msg);
  }

  function VendorKosherHash($Kosher)
  {
    $ret = "חסר";
    switch ($Kosher)
    {
      case 'Kosher':        $ret = "כשר";             break;
      case 'NonKosher':     $ret = "לא כשר";          break;
      case 'SemiKosher':    $ret = "יש מתחם לא כשר";  break;
    }
    return ($ret);
  }

  function VendorWinterHash($Winter)
  {
    $ret = "חסר";
    switch ($Winter)
    {
      case 'Active':    $ret = "פעיל";        break;
      case 'NonActive': $ret = "לא פעיל";     break;
    }
    return ($ret);
  }

  function VendorWinterCoverHash($WinterCover)
  {
    $ret = "חסר";
    switch ($WinterCover)
    {
      case 'NonRelevant': $ret = "לא רלוונטי";  break;
      case 'Cover':       $ret = "קירוי חורף";  break;
      case 'Building':    $ret = "מבנה סגור";   break;
    }
    return ($ret);
  }

  function VendorTivoniHash($Tivoni)
  {
    $ret = "חסר";
    switch ($Tivoni)
    {
      case 'SomeTivoni':    $ret = "יש מנות טבעוניות";        break;
      case 'NonTivoni':     $ret = "אין אפשרות לטבעוני מלא";  break;
      case 'Option2Tivoni': $ret = "אפשרות לטבעוני מלא";      break;
      case 'OnlyTivoni':    $ret = "רק טבעוני";               break;
    }
    return ($ret);
  }

  function VendorVegHash($Veg)
  {
    $ret = "חסר";
    switch ($Veg)
    {
      case 'SomeZtimhoni':    $ret = "יש מנות צמחוניות"; break;
      case 'NonZtimhoni':     $ret = "אין אפשרות לצמחוני מלא"; break;
      case 'Option2Ztimhoni': $ret = "אפשרות לצמחוני מלא"; break;
      case 'OnlyZtimhoni':    $ret = "רק צמחוני"; break;
    }
    return ($ret);
  }

  function VendorNechimHash($Handc)
  {
    $ret = "חסר";
    switch ($Handc)
    {
      case 'FullAccess': $ret = "גישה מלאה";  break;
      case 'PartAccess': $ret = "גישה חלקית"; break;
      case 'ZeroAccess': $ret = "אין גישה";   break;
    }
    return ($ret);
  }

  function VendorParkingHash($Parking)
  {
    $ret = "חסר";
    switch ($Parking)
    {
      case 'LocalParking':  $ret = "חניה של המקום"; break;
      case 'InTheArea':     $ret = "חניה באיזור";   break;
      case 'Paid':          $ret = "חניה בתשלום";   break;
    }
    return ($ret);
  }

  function VendorSpecialHash($Params)
  {
    $ret = "חסר";
    switch ($Params)
    {
      case 'None':    $ret = "ללא";         break;
      case 'Sea':     $ret = "ים";          break;
      case 'Forest':  $ret = "יער";         break;
      case 'City':    $ret = "עירוני";      break;
      case 'Taasiya': $ret = "איזור תעשיה"; break;
      case 'Mall':    $ret = "קניון";       break;
    }
    return ($ret);
  }

  function WorkingWithUsHash($Params)
  {
    $ret = "חסר";
    switch ($Params)
    {
      case 'yes':     $ret = "כן";        break;
      case 'no':      $ret = "לא"; break;
      case 'pending': $ret = "טרם";      break;
    }
    return ($ret);
  }

  function LinkHandler($link, $type)
  {
    $ret = '';
    if ('' == $link) {
      $ret = '<button type="button" class="btn btn-lg btn-primary" disabled="disabled">'. $type . '</button>';
    } else {
      if (strpos($link, 'http'))  $new_link = $link;
      else                        $new_link = 'http://' . $link;
      $ret = '<a href="http://' . $new_link . '" class="btn btn-primary btn-lg active" role="button">'. $type . '</a>';
    }
    return ($ret);
  }

  function DisplayImgs($vendor, $baseLink)
  {
    $ret = '';
    $i=1;
    while ('' != ($vendor[$baseLink . strval($i)]))
    {
      if (1 == ($i % 4)) $ret = $ret . '<div class="row">';
      $ret = $ret . '
        <div class="col-sm-3">
          <img src="' . $vendor[$baseLink.strval($i)] . '" alt="Problem" width="180" class="img-rounded">
        </div>
      ';
      if (0 == ($i%4)) $ret = $ret . '</div><hr>';
      $i = $i + 1;
    }
    if (1 != ($i%4)) $ret = $ret . '</div><hr>'; // 1<i<4 so we need to close the row div
    return ($ret);
  }

  function show_vendor_list($cursor)
  {
    $cursor->sort(array('VendorName' => 1));
    $index=1;
    echo '
      <div class="container" id="vendors_search_results">
        <div class="panel panel-default">
          <div class="panel-heading" align="center"><h2><b>תוצאות חיפוש</b></h2></div>
          <div class="panel-body" align="center">
            <table class="table" style="direction: rtl;">
              <tr>
                <td><b>#</b></td>
                <td><b>שם המקום</b></td>
                <td><b>יש חוזה</b></td>
                <td><b>איזור</b></td>
                <td><b>שם איש קשר</b></td>
                <td><b>טלפון</b></td>
                <td><b>אימייל</b></td>
                <td><b>פרטים</b></td>
                <td><b>עריכה</b></td>
              </tr>';
              foreach ($cursor as $value) {
              echo '
              <tr>
                <td>' . $index . '</td>
                <td>' . $value['VendorName'] . '</td>
                <td>' . WorkingWithUsHash($value['WorkingWithUs']) . '</td>
                <td>' . VendorAreaHash($value['VendorLocation']) . '</td>
                <td>' . $value['ContactName'] . '</td>
                <td>' . $value['ContactPhone'] . '</td>
                <td>' . $value['ContactEmail'] . '</td>
                <td> <a class="btn btn-info" href="vendor_details.php?name='.$value['VendorName'].'" role="button">פרטים</a>
                <td> <a class="btn btn-warning" href="vendor_edit.php?name='.$value['VendorName'].'" role="button">עריכה</a>
              </tr>
              ';
              $index++;
              }
              echo '
            </table>
          </div>
        </div>
      </div>
    ';
  }

 ?>
