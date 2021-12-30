<?php declare(strict_types=1);

namespace Core\FormBuilder;

class FormBuilder
{
    private $form = '';
   

    /**
     * create form
     *
     * @return void
     */
    public function create()
    {
        return $this->form;
    }
    

    /**
     * Début de la balise form
     *
     * @param string $action
     * @param string $method
     * @param string $id
     * @param array $attribute
     * @return self
     */
    public function startForm(
        string $action = "",
        string $method = 'POST',
        string $id = '#',
        array $attribute = []
    ): self {
        $this->form .= '<form  action="' . $action . '"method="' . $method . '"id="' . $id . '"';
        $this->form .= $attribute ? $this->addAttributes($attribute).'>' : '>';
        return $this;
    }

    public function addToken($token): self
    {
        $this->form .= '<input type="hidden" name="token" value="' . $token . '">';
        return $this;
    }
    
    /**
     * Ajoute les attributs du formulaire
     *
     * @param array $attributes
     * @return self
     */
    private function addAttributes(array $attributes): string
    {
        $attribute_data='';
        $short_attributes = ['autocomplete', 'autofocus', 'checked', 'disabled',
        'list', 'multiple', 'readonly', 'required'];
        foreach ($attributes as $key => $value) {
            if (in_array($key, $short_attributes)) {
                $attribute_data .= " $key ";
            } else {
                $attribute_data .=  "$key = '$value'";
            }
        }
        return  $attribute_data;
    }
       
    /**
     * add input
     *
     * @param string $name
     * @param string $value
     * @param array $attribute
     * @return self
     */
    public function addText(string $name, string $value = ' ', array $attribute=[]): self
    {
        $this->form .='<input type="text" name="' . $name . '" value="' . $value . '"';
        $this->form .= $attribute ? $this->addAttributes($attribute).'>' : '>';

        return $this;
    }
    /**
     * email input
     *
     * @param string $name
     * @param string $value
     * @param array $attribute
     * @return self
     */
    public function addEmail(string $name, string $value, array $attribute=[]): self
    {
        $this->form .='<input type="email" name="' . $name . '" value="' . $value . '"';
        $this->form .= $attribute ? $this->addAttributes($attribute).'>' : '>';

        return $this;
    }

    /**
     * password input
     *
     * @param string $name
     * @param string $value
     * @param array $attribute
     * @return self
     */
    public function addPassword(string $name, string $value = ' ', array $attribute=[]): self
    {
        $this->form .='<input type="password" name="' . $name . '" value="' . $value . '"';
        $this->form .= $attribute ? $this->addAttributes($attribute).'>' : '>';

        return $this;
    }

    /**
     * Ajoute un bouton submettre
     * @param string $texte
     * @param array $attributs
     * @return Form
     */
    public function addBouton(string $texte, array $attributs = []):self
    {
        $this->form .= '<button ';
        $this->form .= $attributs ? $this->addAttributes($attributs) : '';
        $this->form .= ">$texte</button>";

        return $this;
    }
    /**
     * add input Textearea
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function addTextarea(string $name, string $value = ''): self
    {
        $this->form .='<textarea name="' . $name . '">' . $value . '</textarea>';
        return $this;
    }
    
    /**
     * add Sélect
     *
     * @param string $name
     * @param array $options
     * @param string $selected
     * @return self
     */
    public function addSelect(string $name, array $options, string $selected = ''): self
    {
        $this->form .='<select name="' . $name . '">';
        foreach ($options as $key => $value) {
            $this->form .= '<option value="' . $key . '"';
            $this->form .= $key == $selected ? ' selected="selected >' : '>';
            $this->form .= $value . '</option>';
        }
        $this->form .='</select>';
        return $this;
    }
    
    /**
     * addCheckbox
     *
     * @param string $name
     * @param string $value
     * @param boolean $checked
     * @return self
     */
    public function addCheckbox(string $name, string $value = '', bool $checked = false): self
    {
        $this->form .='<input type="checkbox" name="' . $name . '" value="' . $value . '"';
        $this->form .= $checked  ? 'checked=checked />' : '/>';
        return $this;
    }
    
    /**
     * addRadio
     *
     * @param string $name
     * @param array $options
     * @param string $selected
     * @return self
     */
    public function addRadio(string $name, array $options, string $selected = ''): self
    {
        foreach ($options as $key => $value) {
            $this->form .='<input type="radio" name="' . $name . '" value="' . $key . '"';
            $this->form .= $key == $selected ? ' checked="checked /> ' : '/> ';
        }
        return $this;
    }
    
    /**
     * addHidden
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function addHidden(string $name, string $value = ''): self
    {
        $this->form .='<input type="hidden" name="' . $name . '" value="' . $value . '" />';
        return $this;
    }
    
    /**
     * addFile
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function addFile(string $name, string $value = ''): self
    {
        $this->form .= '<input type="file" name="' . $name . '" value="' . $value . '" />';
        return $this;
    }

    /**
     * add label
     * @param string $for
     * @param string $texte
     * @param array $attributs
     * @return Form
     */
    public function addFor(string $name, string $texte, array $attributs = []):self
    {
        $this->form .= "<label for='$name'";
        $this->form .= $attributs ? $this->addAttributes($attributs) : '';
        $this->form .= ">$texte</label>";
        return $this;
    }
   
    /**
     * addAttributes
     *
     * @param array $attributs
     * @return string
     */
    public function __toString()
    {
        return $this->form;
    }

    
    
    /**
     * close form
     *
     * @return self
     */
    public function endForm():self
    {
        $this->form .= '</form>';
        return $this;
    }

    public function setRequired(string $name, string $texte, array $attributs = []):self
    {
        $this->form .= "<label for='$name'";
        $this->form .= $attributs ? $this->addAttributes($attributs) : '';
        $this->form .= ">$texte</label>";
        return $this;
    }
}