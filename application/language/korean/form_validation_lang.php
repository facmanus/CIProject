<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']		= '{field}는(은) 필수사항입니다.';
$lang['form_validation_isset']			= '{field} field must have a value.';
$lang['form_validation_valid_email']		= '{field}는(은) 정확한 이메일주소를 가져야합니다.';
$lang['form_validation_valid_emails']		= 'The {field} field must contain all valid email addresses.';
$lang['form_validation_valid_url']		= '{field}는(은) 정확한 url을 가져야합니다.';
$lang['form_validation_valid_ip']		= '{field}는(은) 정확한 ip를 가져야합니다.';
$lang['form_validation_min_length']		= '{field}는(은) 최소 {param} 글자수를 가져야합니다.';
$lang['form_validation_max_length']		= '{field}는(은) 최대 {param} 글자수를 가져야합니다.';
$lang['form_validation_exact_length']		= 'The {field} field must be exactly {param} characters in length.';
$lang['form_validation_alpha']			= '{field}는(은) 영어로만 이루어져야합니다..';
$lang['form_validation_alpha_numeric']		= '{field}는(은) 영어와 숫자로만 이루어져야합니다.';
$lang['form_validation_alpha_numeric_spaces']	= '{field}는(은) 영어와 숫자와 스페이스로만 이루어져야합니다.';
$lang['form_validation_alpha_dash']		= 'The {field}는(은) 영어와 숫자, _ 와 -로만 이루어져야합니다.';
$lang['form_validation_numeric']		= 'The {field}는(은) 숫자로 이루어져야합니다.';
$lang['form_validation_is_numeric']		= 'The {field} field must contain only numeric characters.';
$lang['form_validation_integer']		= 'The {field} field must contain an integer.';
$lang['form_validation_regex_match']		= 'The {field} field is not in the correct format.';
$lang['form_validation_matches']		= '{field}는(은) {param} 과 일치해야합니다.';
$lang['form_validation_differs']		= 'The {field} field must differ from the {param} field.';
$lang['form_validation_is_unique'] 		= 'The {field} field must contain a unique value.';
$lang['form_validation_is_natural']		= 'The {field} field must only contain digits.';
$lang['form_validation_is_natural_no_zero']	= 'The {field} field must only contain digits and must be greater than zero.';
$lang['form_validation_decimal']		= 'The {field} field must contain a decimal number.';
$lang['form_validation_less_than']		= 'The {field} field must contain a number less than {param}.';
$lang['form_validation_less_than_equal_to']	= 'The {field} field must contain a number less than or equal to {param}.';
$lang['form_validation_greater_than']		= 'The {field} field must contain a number greater than {param}.';
$lang['form_validation_greater_than_equal_to']	= 'The {field} field must contain a number greater than or equal to {param}.';
$lang['form_validation_error_message_not_set']	= 'Unable to access an error message corresponding to your field name {field}.';
$lang['form_validation_in_list']		= 'The {field} field must be one of: {param}.';
