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
     * @var
     */
    private $str_replace;

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

        // Set search and replace.
        $this->str_replace();

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
     * String replace array.
     */
    private function str_replace()
    {
        $this->str_replace = [
            '{{username}}' => $this->button_username,
            '{{trigger}}'  => $this->button_trigger
        ];
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

        // Replace username and trigger.
        foreach ($this->str_replace as $find => $replace) {
            $stub = str_replace($find, $replace, $stub);
        }

        // Return the javascript stub.
        return $stub;
    }
}