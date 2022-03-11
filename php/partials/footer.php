<?php

namespace partials;

use lib\Msg;

Msg::flush();
function footer()
{
?>
    </main>
    <script src="<?php echo BASE_JS_PATH ?>main.js"></script>
    </body>

    </html>
<?php
}
?>