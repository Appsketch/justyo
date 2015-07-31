<?php

namespace Appsketch\Justyo;

/**
 * Class YoButton
 *
 * @package Appsketch\Justyo
 */
class YoButton
{
    /**
     * @var
     */
    private $button_username;

    /**
     * @var
     */
    private $button_trigger;

    /**
     * @param $button_username
     * @param $button_trigger
     *
     * @return $this
     */
    public function button($button_username, $button_trigger)
    {
        // Set the username.
        $this->button_username = strtoupper($button_username);

        // Set the trigger.
        $this->button_trigger  = $button_trigger;

        // Return this.
        return $this;
    }

    /**
     * Render the Yo button.
     *
     * @return string
     */
    public function render()
    {
        // Combine both code.
        $code = $this->button_html() . $this->button_javascript();

        // return the code.
        return $code;
    }

    /**
     * Only render the HTML.
     *
     * @return string
     */
    public function html()
    {
        // Return the button HTML.
        return $this->button_html();
    }

    /**
     * Only render the javascript.
     *
     * @return mixed|string
     */
    public function javascript()
    {
        // Return the button javascript.
        return $this->button_javascript();
    }

    /**
     * Get the button's HTML.
     *
     * @return string
     */
    private function button_html()
    {
        // Return the html stub.
        return file_get_contents(__DIR__ . '/stubs/html.stub');
    }

    /**
     * Get the button's javascript.
     *
     * @return mixed|string
     */
    private function button_javascript()
    {
        // Get the button javascript stub.
        $stub = file_get_contents(__DIR__ . '/stubs/javascript.stub');

        // Replace the username.
        $stub = str_replace('{{username}}', $this->button_username, $stub);

        // Replace the trigger.
        $stub = str_replace('{{trigger}}', $this->button_trigger, $stub);

        // Return the javascript stub.
        return $stub;
    }
}