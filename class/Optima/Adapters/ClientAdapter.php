<?php

namespace Optima\Adapters;

use Optima\Entities\AbstractEntity;
use Optima\Enums\OptimaEnums;
use Optima\Extensions\OptimaClient;
use Optima\Interfaces\OptimaClientEntityInterface;
use Optima\Interfaces\OptimaEntityInterface;

/**
 *
 */
class ClientAdapter extends AbstractAdapter {
    public static function getMappedKeys(): array
    {
        return parent::getMappedKeys() + [
                OptimaEnums::CLIENT_TABLE_ID_KEY => 'Knt_KntId',
                'adres' => [
                    'Knt_Ulica',
                    'Knt_NrDomu',
                ],
                'imie' => 'Knt_Nazwa1',
                'nazwisko' => 'Knt_Nazwa2',
                'firma' => [
                    'Knt_Nazwa1',
                    'Knt_Nazwa2',
                    'Knt_Nazwa3',
                ],
                'adres_no' => 'Knt_NrLokalu',
                'miejscowosc' => 'Knt_Miasto',
                'kod_poczt' => 'Knt_KodPocztowy',
                'nip' => 'Knt_Nip',
                'telefon' => 'Knt_Telefon',
                'uzytkownik' => 'Knt_Email',
                'email' => 'Knt_Email',
                'kraj' => 'country', // By Morph
                'haslo' => 'password', // By Morph
                'rejestrowany' => 'rejestrowany', // By Morph
            ];
    }
}