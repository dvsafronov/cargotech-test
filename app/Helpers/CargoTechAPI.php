<?php
declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class CargoTechAPI
{
    const API_URL = 'https://api.cargo.tech/';
    const ON_PAGE = 100;

    private function _sendRequest($url, $data)
    {
        $api_response = Http::get(self::API_URL . $url, $data);
        if (!$api_response->ok()) {
            return false;
        }
        return $api_response->json();
    }

    public function getOneRecord()
    {
        $url = 'v1/cargos';
        return collect([$this->_sendRequest($url, ['limit' => 1])['data'][0]]);
    }

    public function getRecords(int $limit, int $offset)
    {
        $url = 'v1/cargos';
        return collect($this->_sendRequest($url, [
            'limit' => $limit,
            'offset' => $offset
        ])['data']);
    }

    public function getPageOfRecords(int $pages)
    {
        $url = 'v1/cargos';

        // Получение всех страниц
        if ($pages === -1) {
            $response = $this->_sendRequest($url, ['limit' => 1]);
            $pages = ceil((int)$response['meta']['size'] / self::ON_PAGE);
        }

        $result = collect([]);

        for ($page = 1; $page <= $pages; $page++) {
            $offset = (self::ON_PAGE * $page) - self::ON_PAGE;

            $response = $this->_sendRequest($url, [
                'limit' => self::ON_PAGE,
                'offset' => $offset
            ]);

            foreach ($response['data'] as $record) {
                $result->push($record);
            }
        }

        return $result;
    }

}
