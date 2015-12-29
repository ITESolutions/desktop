<h1>Frequently Asked Questions</h1>

<dl>
    <dt>What is Cura?</dt>
    <dd>
        <article>
            <h3>the next thing in management</h3>
            <p>Cura is the management software solution of tomorrow. Cura
            has all the functionality of a personal organizer/assistant. As a
            web-based application, your desktop space is available to you from
            anywhere with an Internet connection from any PC, Mac,
            tablet, <em>or</em> smartphone.</p>
            <p>Cura is a personal assistant program that can help you 
                <span class="co">do more in less time from ANYWHERE!</span>
            Cura features small applications, called applets, that assist with
            personal organization, project management, business administration,
            customer service, and more.</p>
        </article>
    </dd>

    <dt>What does Cura mean?</dt>
    <dd>
        <article>
            <p><strong>cura: (pronounced cū - ra)</strong></p>
            <ol>
                <li>Care, concern, thought; <span class="grayed st">trouble, solicitude; anxiety, grief, sorrow.</span></li>
                <li>Attention, management, administration, charge, care; command, <span class="grayed st">office; guardianship.</span></li>
                <li>Written work, writing.</li>
                <li><span class="grayed st">(medicine) Medical attendance,</span> healing.</li>
                <li><span class="grayed st">(agriculture) Rearing, culture, care.</span></li>
                <li>(rare) An attendant, guardian, observer.</li>
            </ol>
        </article>
    </dd>
            
    
    <dt>How much does it cost?</dt>
    <dd>
        <article>
            <h3>software</h3>
            <p>Cura is packaged as a free download with source code included.
                Cura source code released under the GNU/GPL</p>
            <h3>membership</h3>
            <p>Memberships are currently <em>free</em> to try out the beta
                release, as long as our server supports the load.</p>
        </article>
    </dd>
</dl>

<script type="text/javascript">
    
(function() {
    $('dd').filter(':nth-child(n+4)').hide();

    $('dl').on('click', 'dt', function() {
        $(this).next().slideDown(200).siblings('dd').slideUp(200);

    });
    
    $('article').find('span.co').each(function() {
        var $this = $(this);
        $('<blockquote></blockquote>', {
            class : 'co',
            text : $this.text()
        }).prependTo($this.closest('p'));
    });
})();

</script>
