<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2019 - 2022, CodeIgniter Foundation
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
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @copyright	Copyright (c) 2019 - 2022, CodeIgniter Foundation (https://codeigniter.com/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']		= '%s 필드가 필요합니다.';
$lang['form_validation_isset']			= '%s 필드는 반드시 필요한 값입니다.';
$lang['form_validation_valid_email']		= '%s 필드는 유효한 이메일 주소를 반드시 포함해야 합니다.';
$lang['form_validation_valid_emails']		= '%s 필드는 모든 유효한 이메일 주소를 반드시 포함해야 합니다.';
$lang['form_validation_valid_url']		= '%s 필드는 유효한 URL을 포함해야 합니다.';
$lang['form_validation_valid_ip']		= '%s 필드는 유효한 IP를 포함해야 합니다.';
$lang['form_validation_valid_base64']		= '{field} 필드는 유효한 base64문자열이어야 합니다.';
$lang['form_validation_min_length']		= '%s 필드의 길이는 최소한 %s 개의 문자를 넘어야 합니다.';
$lang['form_validation_max_length']		= '%s 필드의 길이는 최대 %s 개의 문자를 넘어서는 안됩니다.';
$lang['form_validation_exact_length']		= '%s 필드의 길이는 정확히 %s 개의 문자여야 합니다.';
$lang['form_validation_alpha']			= '%s 필드는 알파벳 문자만 포함할 수 있습니다.';
$lang['form_validation_alpha_numeric']		= '%s 필드는 알파벳 문자와 숫자만 포함할 수 있습니다.';
$lang['form_validation_alpha_numeric_spaces']	= '{field} 필드에는 알파벳, 숫자 그리고 공백만 포함시킬 수 있습니다.';
$lang['form_validation_alpha_dash']		= '%s 필드는 알파벳 문자와 숫자, 밑줄, 대시만 포함할 수 있습니다.';
$lang['form_validation_numeric']		= '%s 필드는 반드시 숫자만 포함할 수 있습니다.';
$lang['form_validation_is_numeric']		= '%s 필드는 반드시 숫자만 포함할 수 있습니다.';
$lang['form_validation_integer']		= '%s 필드는 반드시 정수만 포함할 수 있습니다.';
$lang['form_validation_regex_match']		= '{field} 필드의 형식이 맞지 않습니다.';
$lang['form_validation_matches']		= '%s 필드가 %s 필드와 일치하지 않습니다.';
$lang['form_validation_differs']		= '{field} 필드는 {param} 필드와 서로 달라야 합니다.';
$lang['form_validation_is_unique'] 		= '{field} 필드는 유일한 값이어야 합니다.';
$lang['form_validation_is_natural']		= '%s 필드는 반드시 0과 자연수만 포함할 수 있습니다.';
$lang['form_validation_is_natural_no_zero']	= '%s 필드는 반드시 0을 초과하는 자연수만 포함할 수 있습니다.';
$lang['form_validation_decimal']		= '{field} 필드에는 소수(decimal number)만 포함시킬 수 있습니다.';
$lang['form_validation_less_than']		= '{field} 필드 값은 {param}보다 작아야 합니다.';
$lang['form_validation_less_than_equal_to']	= '{field} 필드 값은 {param} 이하여야 합니다.';
$lang['form_validation_greater_than']		= '{field} 필드 값은 {param}보다 커야 합니다.';
$lang['form_validation_greater_than_equal_to']	= '{field} 필드 값은 {param} 이상이어야 합니다.';
$lang['form_validation_error_message_not_set']	= 'Unable to access an error message corresponding to your field name {field}.';
$lang['form_validation_in_list']		= '{field} 필드는 반드시 {param} 중에 하나여야 합니다.';
