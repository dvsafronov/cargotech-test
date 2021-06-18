<?php
declare(strict_types=1);

namespace App\Helpers;

class CargoTechAPI
{
    const API_URL = 'https://api.cargo.tech/';
    const ON_PAGE = 100;

    private function _sendRequest($url, $data)
    {
        $url = self::API_URL . $url;
        $data = http_build_query($data);
        $url .= '?' . $data;
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => 0,
        ];
        $ch = curl_init($url);

        curl_setopt_array($ch, $options);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($info['http_code'] !== 200) {
            return false;
        }
        $result = json_decode($output, true);
        if (json_last_error()) {
            return false;
        }
        return $result;
    }

    public function getOneRecord()
    {
        $url = 'v1/cargos';
        $response = $this->_sendRequest($url, ['limit' => 1]);
        $result = [];
        if (isset($response['data']) && is_array($response['data']) && count($response['data'])) {
            $result = $response['data'][0];
        }
        return collect([$result]);
    }

    public function getRecords(int $pages)
    {
        $url = 'v1/cargos';
        // Получение всех страниц
        if ($pages === -1) {
            $response = $this->_sendRequest($url, ['limit' => 1]);
            $pages = ceil((int)$response['meta']['size'] / self::ON_PAGE);
        }
        $result = collect([]);
        for ($page = 1; $page <= $pages; $page++) {
            $response = $this->_sendRequest($url, ['limit' => self::ON_PAGE, 'offset' => (self::ON_PAGE * $page - self::ON_PAGE)]);
            if (isset($response['data']) && is_array($response['data'])) {
                foreach ($response['data'] as $record) {
                    $result->push($record);
                }
            }
        }
        return $result;
    }

}
