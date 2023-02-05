    <?php

    include_once('v1/config.php');
    include_once('v1/err_handler.php');
    include_once('v1/db_connect.php');
    include_once('v1/functions.php');


    if (preg_match_all("/^(start)$/ui", $_GET['type'])) {

        $content = "Для быстрого доступа к нужной функции кликните на неё и при необходимости введите данные в пустующие поля в адрессной строке<br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=add_admin&name=&second_name=&last_name=&admin_tel=&username=&password='>Добавить админа</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=add_service_log&service_id=&admin_id=&client_id='>Добавить событие в журнал действий</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=show_admin_logs&admin_id='>Вывод журнала определённого админа</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=ban_admin&admin_id='>Забанить админа</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=add_client_card&card_number='>Добавить карту клиента</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=add_client_card&balance=&card_number='>Добавить карту клиента со стартовым балансом</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=update_client_balance&card_id=&balance=&card_number='>Изменить баланс карты клиента</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=show_clients_cards'>Номера карт и их баланс</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=add_client&name=&second_name=&last_name=&client_tel=&username=&password=&card_id='>Добавить клиента</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=list_clients'>Список клиентов</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=ban_client&client_id='>Забанить клиента</a><br>\n

        <a href='https://dev.rea.hrel.ru/NSS/?type=update_service_name&service_id=&name=&name2='>Переименовать услугу</a><br>";

	    echo $content;
    }

//Добавить админа
    if(preg_match_all("/^(add_admin)$/ui", $_GET['type'])){
        if(!isset($_GET['name'])){
            echo ajax_echo(
                "Ошибка!", // Заголовок ответа
                "Вы не указали GET параметр name!", // Описание ответа
                true, // Наличие ошибки в ответе
                "ERROR", // Статус ответа
                null // Дополнительные параметры ответа
            );
            exit();
        }

        if (preg_match_all("/^(add_admin)$/ui", $_GET['type'])) {
            if (!isset($_GET['last_name'])) {
                echo ajax_echo(
                    "Ошибка!",
                    // Заголовок ответа
                    "Вы не указали GET параметр last_name!",
                    // Описание ответа
                    true,
                    // Наличие ошибки в ответе
                    "ERROR",
                    // Статус ответа
                    null // Дополнительные параметры ответа
                );
                exit();
            }
        }
        if (preg_match_all("/^(add_admin)$/ui", $_GET['type'])) {
            if (!isset($_GET['admin_tel'])) {
                echo ajax_echo(
                    "Ошибка!",
                    // Заголовок ответа
                    "Вы не указали GET параметр admin_tel!",
                    // Описание ответа
                    true,
                    // Наличие ошибки в ответе
                    "ERROR",
                    // Статус ответа
                    null // Дополнительные параметры ответа
                );
                exit();
            }
        }
        if (preg_match_all("/^(add_admin)$/ui", $_GET['type'])) {
            if (!isset($_GET['username'])) {
                echo ajax_echo(
                    "Ошибка!",
                    // Заголовок ответа
                    "Вы не указали GET параметр username!",
                    // Описание ответа
                    true,
                    // Наличие ошибки в ответе
                    "ERROR",
                    // Статус ответа
                    null // Дополнительные параметры ответа
                );
                exit();
            }
        }
        if (preg_match_all("/^(add_admin)$/ui", $_GET['type'])) {
            if (!isset($_GET['password'])) {
                echo ajax_echo(
                    "Ошибка!",
                    // Заголовок ответа
                    "Вы не указали GET параметр password!",
                    // Описание ответа
                    true,
                    // Наличие ошибки в ответе
                    "ERROR",
                    // Статус ответа
                    null // Дополнительные параметры ответа
                );
                exit();
            }
        }

        $last_name = '';
        if(isset($_GET['last_name'])){
          $second_name = $_GET['last_name'];
        }
        $middle_name = '';
        if(isset($_GET['second_name'])){
          $middle_name = $_GET['second_name'];
        }
        $admin_tel = '';
        if(isset($_GET['admin_tel'])){
          $admin_tel = $_GET['admin_tel'];
        }
        $username = '';
        if(isset($_GET['username'])){
          $username = $_GET['username'];
        }
        $password = '';
        if(isset($_GET['password'])){
          $password = $_GET['password'];
        }

        
        $query = "INSERT INTO `admins`(";
        
        if(isset($_GET['name']) && iconv_strlen($_GET['name']) > 0){
            $query .= "`name`,";
        }
            $query .= " `second_name`, ";

            $query .= " `last_name`, ";
        
            $query .= " `admin_tel`, ";
        
            $query .= " `username`, ";
            
            $query .= " `password`";

        
        $query .= ") VALUES (";
        if(isset($_GET['name']) && iconv_strlen($_GET['name']) > 0){
            $query .= "'".$_GET['name']."',";
        }
        if(iconv_strlen($second_name) == 0 || preg_match_all("/^(NULL)$/ui", $second_name)){
            $query .= "NULL ,";
        } else {
            $query .= "'".$second_name."',";
        } 
        if(isset($_GET['last_name']) && iconv_strlen($_GET['last_name']) > 0){
            $query .= "'".$_GET['last_name']."',";
        }
        if(isset($_GET['admin_tel']) && iconv_strlen($_GET['admin_tel']) > 0){
            $query .= "'".$_GET['admin_tel']."',";
        }
        if(isset($_GET['username']) && iconv_strlen($_GET['username']) > 0){
            $query .= "'".$_GET['username']."',";
        }
        if(isset($_GET['password']) && iconv_strlen($_GET['password']) > 0){
            $query .= "'".$_GET['password']."'";
        }

        $query .= ");";


        $res_query = mysqli_query($connection, $query);

        if(!$res_query){
            echo ajax_echo(
                "Ошибка!",
                "Ошибка в запросе!",
                true,
                "ERROR",
                null
            );
            exit();
        }
        
        echo ajax_echo(
            "Уcпех!",
            "Новый админ добавлен в БД!",
            false,
            "SUCCESS",
            null
        );
        exit();
    }

// добавить карту клиента  
else if(preg_match_all("/^(add_client_card)$/ui", $_GET['type'])){
    if(!isset($_GET['card_number'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр card_number!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    $query = "INSERT INTO `clients_cards`(`balance`,`card_number`) VALUES (";

    if(isset($_GET['balance']) == 0 || preg_match_all("/^(NULL)$/ui", $_GET['balance'])){
        $query .= "NULL ,";
    } else {
        $query .= "'".$_GET['balance']."',";
    } 
    if(isset($_GET['card_number']) && iconv_strlen($_GET['card_number']) > 0){
        $query .= "'".$_GET['card_number']."'";
    }

    $query .= ");";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
        "Уcпех!",
        "Новая карта клиента добавлена в БД!",
        false,
        "SUCCESS",
        null
    );
    exit();
}
//Добавление клиента
if(preg_match_all("/^(add_client)$/ui", $_GET['type'])){
    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Ошибка!", // Заголовок ответа
            "Вы не указали GET параметр name!", // Описание ответа
            true, // Наличие ошибки в ответе
            "ERROR", // Статус ответа
            null // Дополнительные параметры ответа
        );
        exit();
    }

    if (preg_match_all("/^(add_client)$/ui", $_GET['type'])) {
        if (!isset($_GET['last_name'])) {
            echo ajax_echo(
                "Ошибка!",
                // Заголовок ответа
                "Вы не указали GET параметр last_name!",
                // Описание ответа
                true,
                // Наличие ошибки в ответе
                "ERROR",
                // Статус ответа
                null // Дополнительные параметры ответа
            );
            exit();
        }
    }
    if (preg_match_all("/^(add_client)$/ui", $_GET['type'])) {
        if (!isset($_GET['client_tel'])) {
            echo ajax_echo(
                "Ошибка!",
                // Заголовок ответа
                "Вы не указали GET параметр client_tel!",
                // Описание ответа
                true,
                // Наличие ошибки в ответе
                "ERROR",
                // Статус ответа
                null // Дополнительные параметры ответа
            );
            exit();
        }
    }
    if (preg_match_all("/^(add_client)$/ui", $_GET['type'])) {
        if (!isset($_GET['username'])) {
            echo ajax_echo(
                "Ошибка!",
                // Заголовок ответа
                "Вы не указали GET параметр username!",
                // Описание ответа
                true,
                // Наличие ошибки в ответе
                "ERROR",
                // Статус ответа
                null // Дополнительные параметры ответа
            );
            exit();
        }
    }
    if (preg_match_all("/^(add_client)$/ui", $_GET['type'])) {
        if (!isset($_GET['password'])) {
            echo ajax_echo(
                "Ошибка!",
                // Заголовок ответа
                "Вы не указали GET параметр password!",
                // Описание ответа
                true,
                // Наличие ошибки в ответе
                "ERROR",
                // Статус ответа
                null // Дополнительные параметры ответа
            );
            exit();
        }
    }

    $last_name = '';
    if(isset($_GET['last_name'])){
      $last_name = $_GET['last_name'];
    }
    $second_name = '';
    if(isset($_GET['second_name'])){
      $second_name = $_GET['second_name'];
    }
    $client_tel = '';
    if(isset($_GET['client_tel'])){
      $client_tel = $_GET['client_tel'];
    }
    $username = '';
    if(isset($_GET['username'])){
      $username = $_GET['username'];
    }
    $password = '';
    if(isset($_GET['password'])){
      $password = $_GET['password'];
    }

    
    $query = "INSERT INTO `clients`(";
    
    if(isset($_GET['name']) && iconv_strlen($_GET['name']) > 0){
        $query .= "`name`,";
    }
        $query .= " `second_name`, ";

        $query .= " `last_name`, ";
    
        $query .= " `client_tel`, ";
    
        $query .= " `username`, ";
        
        $query .= " `password`, ";

        $query .= " `card_id` ";

    
    $query .= ") VALUES (";
    if(isset($_GET['name']) && iconv_strlen($_GET['name']) > 0){
        $query .= "'".$_GET['name']."',";
    }
    if(iconv_strlen($second_name) == 0 || preg_match_all("/^(NULL)$/ui", $second_name)){
        $query .= "NULL ,";
    } else {
        $query .= "'".$second_name."',";
    } 
    if(isset($_GET['last_name']) && iconv_strlen($_GET['last_name']) > 0){
        $query .= "'".$_GET['last_name']."',";
    }
    if(isset($_GET['client_tel']) && iconv_strlen($_GET['client_tel']) > 0){
        $query .= "'".$_GET['client_tel']."',";
    }
    if(isset($_GET['username']) && iconv_strlen($_GET['username']) > 0){
        $query .= "'".$_GET['username']."',";
    }
    if(isset($_GET['password']) && iconv_strlen($_GET['password']) > 0){
        $query .= "'".$_GET['password']."',";
    }
    if(isset($_GET['card_id']) && iconv_strlen($_GET['card_id']) > 0){
        $query .= "'".$_GET['card_id']."'";
    }

    $query .= ");";


    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    
    echo ajax_echo(
        "Уcпех!",
        "Новый клиент добавлен в БД!",
        false,
        "SUCCESS",
        null
    );
    exit();
}
// добавить лог операции
else if(preg_match_all("/^(add_service_log)$/ui", $_GET['type'])){
    if(!isset($_GET['service_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр service_id!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    if (preg_match_all("/^(add_service_log)$/ui", $_GET['type'])) {
        if (!isset($_GET['admin_id'])) {
            echo ajax_echo(
                "Ошибка!",
                // Заголовок ответа
                "Вы не указали GET параметр admin_id!",
                // Описание ответа
                true,
                // Наличие ошибки в ответе
                "ERROR",
                // Статус ответа
                null // Дополнительные параметры ответа
            );
            exit();
        }
    }
    if (preg_match_all("/^(add_service_log)$/ui", $_GET['type'])) {
        if (!isset($_GET['client_id'])) {
            echo ajax_echo(
                "Ошибка!",
                // Заголовок ответа
                "Вы не указали GET параметр client_id!",
                // Описание ответа
                true,
                // Наличие ошибки в ответе
                "ERROR",
                // Статус ответа
                null // Дополнительные параметры ответа
            );
            exit();
        }
    }

    $query = "INSERT INTO `services_log`(`service_id`,`admin_id`,`client_id`) VALUES ('".$_GET['service_id']."','".$_GET['admin_id']."','".$_GET['client_id']."')";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
        "Уcпех!",
        "Лог по операции добавлен в БД!",
        false,
        "SUCCESS",
        null
    );
    exit();
}


// обновить название услуги

else if(preg_match_all("/^(update_service_name)$/ui", $_GET['type'])){


    if(!isset($_GET['name'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр name!",
            true,
            "ERROR",
            null
        );
        exit();
    } else{
        $name =  $_GET['name'];
    }

    
    $name2 = '';
    if(isset($_GET['name2'])){
      $name2 = $_GET['name2'];
    }
    $service_id = '';
    if(isset($_GET['id'])){
      $service_id = $_GET['id'];
    }


    if(!isset($_GET['name2']) && !isset($_GET['id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр name2 или id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    

    $query = "UPDATE `services` SET `name`= '" .$name. "' WHERE ";   
    if(iconv_strlen($name2) > 0 ){
        $query .= " `name`= '".$name2."' ";
    }
    if(iconv_strlen($name2) > 0 && iconv_strlen($service_id) > 0 ){
        $query .= " AND ";
    }

    if(iconv_strlen($service_id) > 0){
        $query .= " `id`='".$service_id."'";
    }     
    $query .= ";";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    echo ajax_echo(
        "Уcпех!",
        "Название услуги изменено в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
} 

//изменение баланса карты клиента
else if(preg_match_all("/^(update_client_balance)$/ui", $_GET['type'])){
    if(!isset($_GET['balance'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр balance!",
            true,
            "ERROR",
            null
        );
        exit();
    } else{
        $balance =  $_GET['balance'];
    }

    
    $card_number = '';
    if(isset($_GET['card_number'])){
      $card_number = $_GET['card_number'];
    }
    $card_id = '';
    if(isset($_GET['id'])){
      $card_id = $_GET['id'];
    }


    if(!isset($_GET['card_number']) && !isset($_GET['id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр card_number или id!",
            true,
            "ERROR",
            null
        );
        exit();
    }

    

    $query = "UPDATE `clients_cards` SET `balance`= '" .$balance. "' WHERE ";   
    if(iconv_strlen($card_number) > 0 ){
        $query .= " `card_number`= '".$card_number."' ";
    }
    if(iconv_strlen($card_number) > 0 && iconv_strlen($card_id) > 0 ){
        $query .= " AND ";
    }

    if(iconv_strlen($card_id) > 0){
        $query .= " `id`='".$card_id."'";
    }     
    $query .= ";";

    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    echo ajax_echo(
        "Уcпех!",
        "Баланс карты клиента обновлён в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
} 

// список операций у определённого администратора
if(preg_match_all("/^(show_admin_logs)$/ui", $_GET['type'])){
$admin_id = '';
if(isset($_GET['admin_id'])){
  $admin_id = $_GET['admin_id'];
}

$query = "SELECT * FROM `services_log` WHERE `admin_id` = '" .$admin_id. "'";
   
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}


$arr_res = array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = mysqli_fetch_assoc($res_query);
    array_push($arr_res, $row);
}

echo ajax_echo(
    "Уcпех!",
    "Список операций админа выведен!",
    false,
    "SUCCESS",
    $arr_res
);
exit();
}


// список клиентов
if(preg_match_all("/^(list_clients)$/ui", $_GET['type'])){

$query = "SELECT `id`, `name`, `second_name`, `last_name`, `username`, `card_id` FROM `clients` WHERE `is_banned` = 0";
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}

$arr_res = array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = mysqli_fetch_assoc($res_query);
    array_push($arr_res, $row);
}

echo ajax_echo(
    "Уcпех!",
    "Список клиентов",
    false,
    "SUCCESS",
    $arr_res
);
exit();
}

//Бан клиента
else if(preg_match_all("/^(ban_client)$/ui", $_GET['type'])){
    if(!isset($_GET['client_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр client_id!",
            true,
            "ERROR",
            null
        );
        exit();
    } else{
        $client_id =  $_GET['client_id'];
    }

    
    $query = "UPDATE `clients` SET `is_banned`= 1 WHERE `id` = '" .$client_id. "'";   
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    echo ajax_echo(
        "Уcпех!",
        "Клиент заблокирован в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
} 

//Бан админа
else if(preg_match_all("/^(ban_admin)$/ui", $_GET['type'])){
    if(!isset($_GET['admin_id'])){
        echo ajax_echo(
            "Ошибка!",
            "Вы не указали Get параметр admin_id!",
            true,
            "ERROR",
            null
        );
        exit();
    } else{
        $admin_id =  $_GET['admin_id'];
    }

    
    $query = "UPDATE `admins` SET `is_banned`= 1 WHERE `id` = '" .$admin_id. "'";   
    $res_query = mysqli_query($connection, $query);

    if(!$res_query){
        echo ajax_echo(
            "Ошибка!",
            "Ошибка в запросе!",
            true,
            "ERROR",
            null
        );
        exit();
    }
    echo ajax_echo(
        "Уcпех!",
        "Админ заблокирован в бд!",
        false,
        "SUCCESS",
        null
    );
    exit();
} 

//Вывод списка карт клиентов с балансом

if(preg_match_all("/^(show_clients_cards)$/ui", $_GET['type'])){
$query = "SELECT `card_number`, `balance` FROM `clients_cards`";
$res_query = mysqli_query($connection, $query);

if(!$res_query){
    echo ajax_echo(
        "Ошибка!",
        "Ошибка в запросе!",
        true,
        "ERROR",
        null
    );
    exit();
}

$arr_res = array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = mysqli_fetch_assoc($res_query);
    array_push($arr_res, $row);
}

echo ajax_echo(
    "Уcпех!",
    "Список карт с балансом",
    false,
    "SUCCESS",
    $arr_res
);
exit();
}