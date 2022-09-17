<?php
if (! function_exists('input'))
{
	function input($data = '', $extra = [], $type = 'text'): string
	{
		$validation =  \Config\Services::validation();
		$error = $validation->getError($data);
		if(!isset( $extra['label'])) {
			$extra['label'] = [];
		}

		if(!isset($extra['input']['value'])) {
			$extra['input']['value'] = '';
		}

		if(!empty(set_value($data))) {
			$extra['input']['value'] = set_value($data, null, $extra['input']['html_escape'] ?? true);
		}

		$extra['input']['class'] ?? $extra['input']['class'] = '';
		$extra['input']['class'] .= ' form-control';
		if(!empty($error)) {
			$extra['input']['class'] .= ' is-invalid';
		}

		$options = [];
		if(isset($extra['input']['options'])) {
			$options = $extra['input']['options'];
			unset($extra['input']['options']);
		}

		$help = isset($extra['help']) && !empty($extra['help']) ? $extra['help'] : '';
		

		$divAttr = "";
		if(isset($extra['div'])) {
			if(!isset($extra['div']['class'])) {
				$extra['div']['class'] = 'form-group';
			} else {
				if(strpos($extra['div']['class'], 'form-group') === false) {
					$extra['div']['class'] .= ' form-group';
				}
			}
		} else {
			$extra['div']['class'] = 'form-group ';
		}	

		$divAttr = stringify_attributes($extra['div']);

		$str = "<div {$divAttr}>";

		$str .= form_label(empty($extra['label']['label']) ? humanize($data) : $extra['label']['label'] , $data, $extra['label']);

		if(!isset($extra['input']['id'])) {
			$extra['input']['id'] = $data;
		}		

		$value = $extra['input']['value'];
		unset($extra['input']['value']);

		if($type == 'textarea') {
			$str .= form_textarea($data, $value, $extra['input']);
			$str .= "<span class='form-text'>{$help}</span>";
		} elseif($type == 'select') {
			$str .= form_dropdown($data, $options, $value, $extra['input']);
			$str .= "<span class='form-text'>{$help}</span>";
		} elseif($type == 'file') {
			$str .= '<div class="custom-file">';
			$str .= form_upload($data, $value, $extra['input'], $type);
			$str .= '<label class="custom-file-label" for="'.$data.'">Choose file</label>';
			$str .= "<span class='form-text'>{$help}</span>";
			if(!empty($error)) {
				$error = str_replace($data, humanize($data), $error);
				$error = str_replace('field', '', $error);
				$str .= "<span class='error invalid-feedback'>{$error}</span>";
			}
			$str .= '</div>';
		} else {
			$str .= form_input($data, $value, $extra['input'], $type);
			$str .= "<span class='form-text'>{$help}</span>";
		}

		if(!empty($error) && !in_array($type, ['file'])) {
			$error = str_replace($data, humanize($data), $error);
			$error = str_replace('field', '', $error);
			$str .= "<span class='form-text'>{$help}</span>";
			$str .= "<span class='error invalid-feedback'>{$error}</span>";
		}
		$str .= '</div>';
        return $str;
	}
}
