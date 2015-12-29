<?php

class Image {
    
    private $_source = false, $_handle = false, $_mimetype;
    
    public function __construct($source = FALSE) {
        if (!$source) {
            echo "No source file provided";
        } else {
            $this->source = $source;
            echo $this->getType();
        }
    }
    
    public function getType() {
        if ($this->_source) {
            return pathinfo($this->_source, PATHINFO_EXTENSION);
        }
    }
    
    public function getHandle() {
        if (!$this->_handle) {
            
        }
        return $this->_handle;
    }
    
    public function getDomColor() {
        $maxheight = 300;
        $barwidth = 2;
        $im = $this->getHandle();
        $imgw = imagesx($im);
        $imgh = imagesy($im);
        $n = $imgw*$imgh; // n = total number or pixels
        $histo = array();

        for ($i=0; $i<$imgw; $i++) {
            for ($j=0; $j<$imgh; $j++) {
                $rgb = ImageColorAt($im, $i, $j); // get the rgb value for current pixel
                $r = ($rgb >> 16) & 0xFF; // extract each value for r, g, b
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $V = round(($r + $g + $b) / 3); // get the Value from the RGB value
                $histo[$V] += $V / $n; // add the point to the histogram
// find the maximum in the histogram in order to display a normated graph

$max = 0;
for ($i=0; $i<255; $i++)
{
        if ($histo[$i] > $max)
        {
                $max = $histo[$i];
        }
}

echo "<div style='width: ".(256*$barwidth)."px; border: 1px solid'>";
for ($i=0; $i<255; $i++)
{
        $val += $histo[$i];

        $h = ( $histo[$i]/$max )*$maxheight;

        echo "<img src=\"img.gif\" width=\"".$barwidth."\"
height=\"".$h."\" border=\"0\">";
}
echo "</div>";
            }
        }
    }
}
?>