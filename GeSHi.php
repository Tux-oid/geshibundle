<?php
/**
 * Copyright (c) 2008 - 2012, Peter Vasilevsky
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the RL nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL PETER VASILEVSKY BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace RL\GeSHiBundle;

require_once __DIR__ . "/../../../../easybook/geshi/geshi.php";

/**
 * RL\GeSHiBundle\GeSHi
 *
  * @author Peter Vasilevsky <tuxoiduser@gmail.com> a.k.a. Tux-oid
 * @license BSDL
 */
class GeSHi
{

    /**
     * @var string
     */
    protected $code;

    /**
     * @var
     */
    protected $geshi;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->geshi = new \GeSHi('', '');
        $this->geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 1);
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->geshi->set_language($language);
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->geshi->get_language_name();
    }

    /**
     * @param string $text
     */
    public function setCode($code)
    {
        $this->code = $code;
        $this->geshi->set_source($code);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @returns string
     */
    public function render()
    {
        return geshi_highlight($this->getCode(), $this->getLanguage(), null, true);
    }

    /**
     * @param string $language
     * @param string $code
     * @returns string
     */
    public function highlight($code, $language = "c")
    {
        $this->setLanguage($language);
        $this->setCode($code);

        return $this->render();
    }

    /**
     * @return array
     */
    public function getHighlightedLanguagesList()
    {
        $languages = $this->geshi->get_supported_languages();
        asort($languages);

        return $languages;
    }

    public function getGeSHi()
    {
        return $this->geshi;
    }

}
