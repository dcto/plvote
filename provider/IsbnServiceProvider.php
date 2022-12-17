<?php

namespace App\Provider;


class IsbnServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('isbn', function(){            
            return $this;
        });
    }


    /**
     * 检测香港身份证号算法
     *Check digit algorithm is variation of the ISBN-10 check digit algorithm
     *@see https://www.hkpl.gov.hk/en/about-us/services/book-registration/13-digit.html
     *@author dc.To
     *@version 20221215
     */
    public function validHongkongId($id)
    {
        $id = preg_replace(['/[-\/\s]/', '/[\(\)]/'],'', strtoupper($id)); //ID正则替换
        if(!preg_match('/^[A-NP-Z]{1,2}[0-9]{6}[0-9A]$/', $id)) return false; //ID正则校对
		$weight = strlen($id);//HKID长度
		$weightedSum = $weight == 8 ? 324 : 0; //HKID权重
		$identifier = substr($id, 0, -1);
		$checkDigit = substr($id, -1) == 'A' ? 10 : substr($id, -1);

		foreach (str_split($identifier) as $char){
            $charValue = ctype_alpha($char) ? $this->charCodeAt($char, 0) - 55 : +$char; //HKID = { A: 10, B: 11... Z: 35 } so charcode - 55
            $weightedSum += $charValue * $weight;
            $weight--;
        }
        return ($weightedSum + $checkDigit) % 11 == 0;//判断algorithm算法布尔值
    }

    /**
     * 获取字符码位
     * 
     */
    public function charCodeAt($str, $index = 0)
    {
        $utf16 = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
        return ord($utf16[$index * 2]) + (ord($utf16[$index * 2 + 1]) << 8);
    }

}