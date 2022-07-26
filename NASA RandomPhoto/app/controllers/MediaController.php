<?php

class MediaController
{
    private $model;

    /**
     * Init constructor with a necessary services.
     */
    public function __construct()
    {
        try {
            // create db connection driver instance
            $dbh = Dbconn::getMySQL(
                MYSQL_DSN, MYSQL_USER, MYSQL_PASS
            );
        } catch (\PDOException $e) {
            $error = 'Could not connect to database: '.$e->getMessage();
            require_once VIEWS_DIR . '/error.php';
            exit;  
        }

        // 1. create a model class instance
        $this->model = new Media();

        // 2. set low level driver
        $this->model->setDriver($dbh);
    }

    public function save()
    {
        //echo "save data to db";
        $media = $this->loadData();

        foreach($media as $item)
        {
            $this->model->save(
                $item['date'],
                $item['explanation'],
                $item['hdurl'],
                $item['media_type'],
                $item['service_version'],
                $item['title'],
                $item['url']
            );
        }

        // echo "<pre>";
        // print_r($media);
        // echo "</pre>";
    }

    public function loadData()
    {
        return json_decode(
            file_get_contents(NASA_APOD_API_URL), true
        );
    }

    public function show()
    {
        $randomPhoto = $this->model->findURLById();
        //print_r($randomPhoto);
        
        require_once VIEWS_DIR . '/show.php';
    }
}