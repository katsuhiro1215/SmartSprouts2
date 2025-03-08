<?php

namespace App\Constants;

class SortOrder
{
  const Latest = '0';
  const Oldest = '1';
  const LastNameKana_Asc = '2';
  const LastNameKana_Desc = '3';
  const FirstNameKana_Asc = '4';
  const FirstNameKana_Desc = '5';

  const SORT_ORDER = [
    self::Latest => '最新順',
    self::Oldest => '古い順',
    self::LastNameKana_Asc => '姓（カナ）昇順',
    self::LastNameKana_Desc => '姓（カナ）降順',
    self::FirstNameKana_Asc => '名（カナ）昇順',
    self::FirstNameKana_Desc => '名（カナ）降順',
  ];
}
