<?php

namespace Framework\Cura\helpers;

/**
 * Description of Window
 *
 * @author Corey
 */
class Window
{
    const
            DEFAULT_PADDING = 3,
            MIN_HEIGHT = 100,
            IBORDER_WIDTH = 1,
            OBORDER_WIDTH = 1,
            SPACING = 20;
    
    public
            $title,
            $body,
            $offsetX,
            $offsetY;
    
    public static
            $instances;


    public function __construct( $title = 'untitled', $body = 'Body Content') {
        $this->title = $title;
        $this->body = $body;
        self::$instances[] = $this;
        $this->offsetX = self::SPACING * count(self::$instances);
        $this->offsetY = self::SPACING * count(self::$instances);
    }
    
    public static function initialize() {
        ?>
            
<style>
.window {
    position: relative;
    border: 1px solid #333333;
    box-shadow: 3px 3px 5px  #333333;
    border-radius: 3px;
    top: 100px;
    left: 100px;
    margin: 0px;
    padding: <?php echo '5'; ?>px;
    z-index: 2;
    background-color: #FFFFFF;
    display: inline-block;
}

.window_header {

    margin: 0px;
    padding: 0px;
    width: 100%;
    display: block;
    text-align: center;
    color: #333333;
}

.window_body {
    border: 1px solid #333333;
    margin: 0px;
    padding: 0px;
    width: 100%;
    height: 100%;
    min-height: <?php echo '50'; ?>px;
    min-width: 200px;
    color: #333333;
}
</style>

<script>
    

    
var Window = function(title, body, x, y) {
    this.title = title;
    this.body = body;
    this.x = x;
    this.y = y;
};

Window.prototype.addToDesktop = function() {
    
};

</script>

<?php
    }
    
    public function render() {
        ?>
<div class="window move">
    <div class="window_header">
        <?php echo $this->title; ?>
    </div>
    <div class="window_body">
        <?php echo addslashes($this->body); ?>

    </div>
</div>
<?php
    }
}
