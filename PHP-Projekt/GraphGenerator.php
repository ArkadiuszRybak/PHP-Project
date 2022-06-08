<?php

class GraphGenerator
{


    public function run($domainStart,$domainEnd,$polynomial)
    {







        $img = imagecreatetruecolor(1200, 600);
        $white = imagecolorallocate($img, 255, 255, 255);
        $black = imagecolorallocate($img, 0, 0, 0);
        $red = imagecolorallocate($img, 255, 0, 0);
        $grey = imagecolorallocate($img, 225, 223, 223);
        $green = imagecolorallocate($img, 0, 223, 82);
        imagefill($img, 0, 0, $white);



        $distanceOfPoints = ($domainEnd - $domainStart) / 200;

        $polynomialValues = [];


        for ($i = ($domainStart) * 10; $i <= ($domainEnd + $distanceOfPoints) * 10; $i += ($distanceOfPoints) * 10) {
            $value = 0;
            for ($j = 0; $j < sizeof($polynomial); $j++) {
                $value += pow($i / 10, $j) * $polynomial[$j];

            }


            $polynomialValues[] = $value;
        }


        $minPolynomialValue = min($polynomialValues);
        $maxPolynomialValue = max($polynomialValues);


        $graduationDistanceX = round(abs($domainStart - $domainEnd) / 15, decimalPlaces(abs($domainStart - $domainEnd) / 15));
        $graduationDistanceXPixels = round(abs(($graduationDistanceX / ($domainEnd - $domainStart))) * 1000);

        $graduationDistanceY = round(abs($maxPolynomialValue - $minPolynomialValue) / 10, decimalPlaces(abs($maxPolynomialValue - $minPolynomialValue) / 10));
        $graduationDistanceYPixels = round(abs(($graduationDistanceY / ($maxPolynomialValue - $minPolynomialValue))) * 500);



        $xAxisGenerator = function($xAxisLevel)use($domainEnd,$domainStart,$img,$grey,$black,$graduationDistanceX,$graduationDistanceXPixels){
            if ($domainStart <= 0 && $domainEnd >= 0) {
                $yAxisLevel = round(abs($domainStart / ($domainEnd - $domainStart)) * 1000 + 100);
                $x = $yAxisLevel;
                $timesChanged = 0;
                while ($x > 15) {
                    ImageLine($img, $x, 0, $x, 600, $grey);
                    ImageLine($img, $x, $xAxisLevel - 10, $x, $xAxisLevel + 10, $black);
                    Imagestring($img, 1, $x, $xAxisLevel + 15, $timesChanged * $graduationDistanceX, $black);
                    $timesChanged--;
                    $x -= $graduationDistanceXPixels;
                }
                $x = $yAxisLevel;
                $timesChanged = 0;
                while ($x < 1185) {
                    ImageLine($img, $x, 0, $x, 600, $grey);
                    ImageLine($img, $x, $xAxisLevel - 10, $x, $xAxisLevel + 10, $black);
                    Imagestring($img, 1, $x, $xAxisLevel + 15, $timesChanged * $graduationDistanceX, $black);
                    $timesChanged++;
                    $x += $graduationDistanceXPixels;
                }
            } else {
                $x = 100;
                $timesChanged = 0;
                while ($x > 15) {
                    ImageLine($img, $x, 0, $x, 600, $grey);
                    ImageLine($img, $x, $xAxisLevel - 10, $x, $xAxisLevel + 10, $black);
                    Imagestring($img, 1, $x, $xAxisLevel + 15, $domainStart + $timesChanged * $graduationDistanceX, $black);
                    $x -= $graduationDistanceXPixels;
                    $timesChanged--;
                }
                $x = 100;
                $timesChanged = 0;
                while ($x < 1185) {
                    ImageLine($img, $x, 0, $x, 600, $grey);
                    ImageLine($img, $x, $xAxisLevel - 10, $x, $xAxisLevel + 10, $black);
                    Imagestring($img, 1, $x, $xAxisLevel + 15, $domainStart + $timesChanged * $graduationDistanceX, $black);
                    $x += $graduationDistanceXPixels;
                    $timesChanged++;
                }

            }
            ImageLine($img, 0, $xAxisLevel, 1200, $xAxisLevel, $black);

        };


        if ($maxPolynomialValue >= 0 && $minPolynomialValue <= 0) {

            $xAxisGenerator(round(abs($maxPolynomialValue / ($maxPolynomialValue - $minPolynomialValue)) * 500 + 50));


        } elseif ($maxPolynomialValue < 0) {
            $xAxisGenerator(25);

        } else {

            $xAxisGenerator(575);
        }





        $yAxisGenerator = function ($yAxisLevel) use($maxPolynomialValue,$minPolynomialValue,$img,$grey,$black,$graduationDistanceY,$graduationDistanceYPixels){
            if ($maxPolynomialValue >= 0 && $minPolynomialValue <= 0) {
                $xAxisLevel = round(abs($maxPolynomialValue / ($maxPolynomialValue - $minPolynomialValue)) * 500 + 50);
                $y = $xAxisLevel;
                $timesChanged = 0;
                while ($y > 15) {
                    $y -= $graduationDistanceYPixels;
                    $timesChanged++;
                    ImageLine($img, 0, $y, 1200, $y, $grey);
                    ImageLine($img, $yAxisLevel - 10, $y, $yAxisLevel + 10, $y, $black);
                    Imagestring($img, 1, $yAxisLevel - 15, $y, $timesChanged * $graduationDistanceY, $black);

                }
                $y = $xAxisLevel;
                $timesChanged = 0;
                while ($y < 585) {
                    $y += $graduationDistanceYPixels;
                    $timesChanged--;
                    ImageLine($img, 0, $y, 1200, $y, $grey);
                    ImageLine($img, $yAxisLevel - 10, $y, $yAxisLevel + 10, $y, $black);
                    Imagestring($img, 1, $yAxisLevel - 15, $y, $timesChanged * $graduationDistanceY, $black);

                }
            } else {
                $y = 50;
                $timesChanged = 0;
                while ($y > 15) {
                    ImageLine($img, 0, $y, 1200, $y, $grey);
                    ImageLine($img, $yAxisLevel - 10, $y, $yAxisLevel + 10, $y, $black);
                    Imagestring($img, 1, $yAxisLevel - 15, $y, $maxPolynomialValue + $timesChanged * $graduationDistanceY, $black);
                    $y -= $graduationDistanceYPixels;
                    $timesChanged++;
                }
                $y = 50;
                $timesChanged = 0;
                while ($y < 585) {
                    ImageLine($img, 0, $y, 1200, $y, $grey);
                    ImageLine($img, $yAxisLevel - 10, $y, $yAxisLevel + 10, $y, $black);
                    Imagestring($img, 1, $yAxisLevel - 15, $y, $maxPolynomialValue + $timesChanged * $graduationDistanceY, $black);
                    $y += $graduationDistanceYPixels;
                    $timesChanged--;
                }
            }
            ImageLine($img, $yAxisLevel, 0, $yAxisLevel, 600, $black);
        };



        if($domainStart <= 0 && $domainEnd >= 0) {
            $yAxisLevel = round(abs($domainStart / ($domainEnd - $domainStart)) * 1000 + 100);
            $yAxisGenerator($yAxisLevel);


        } elseif ($domainStart > 0) {
            $yAxisLevel = 25;

            $yAxisGenerator($yAxisLevel);
        } else {
            $yAxisLevel = 1175;
            $yAxisGenerator($yAxisLevel);
        }


        $x1 = 100;
        $y1 = round(abs(($maxPolynomialValue - $polynomialValues[0]) / ($maxPolynomialValue - $minPolynomialValue)) * 500);
        for ($i = 1; $i < 201; $i++) {
            $x2 = $x1 + 5;
            $y2 = round(abs(($maxPolynomialValue - $polynomialValues[$i]) / ($maxPolynomialValue - $minPolynomialValue)) * 500);
            ImageLine($img, $x1, $y1 + 50, $x2, $y2 + 50, $red);
            $x1 = $x2;
            $y1 = $y2;
        }


        imagejpeg($img, "img/0.jpg");
        imagedestroy($img);


    }

}