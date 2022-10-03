<?php

class __Mustache_0b5e8426a201109e7243cba6b72eb2a4 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $value = $context->find('ltoolfocus');
        $buffer .= $this->section425c2857269df314d4017a50391ffa2d($context, $indent, $value);

        return $buffer;
    }

    private function sectionE6f9f8231d272fd6146e9a88a566dd46(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'enable';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda($result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'enable';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section425c2857269df314d4017a50391ffa2d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="ltoolfocus-info {{#focusmode}}enable{{/focusmode}}" id="ltoolfocus-info" data-tool="focus"
    data-focuscssurl="{{focuscssurl}}">
        <button type="submit" id="ltoolfocus-action" data-hovercolor="{{iconbackcolor}}"
        data-fontcolor="{{iconcolor}}" style="background:{{iconbackcolor}};">
            <i class="{{icon}}" style="color:{{iconcolor}}"></i>
        </button>
        <p>{{focushovername}} </p>
    </div>
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda($result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <div class="ltoolfocus-info ';
                $value = $context->find('focusmode');
                $buffer .= $this->sectionE6f9f8231d272fd6146e9a88a566dd46($context, $indent, $value);
                $buffer .= '" id="ltoolfocus-info" data-tool="focus"
';
                $buffer .= $indent . '    data-focuscssurl="';
                $value = $this->resolveValue($context->find('focuscssurl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">
';
                $buffer .= $indent . '        <button type="submit" id="ltoolfocus-action" data-hovercolor="';
                $value = $this->resolveValue($context->find('iconbackcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"
';
                $buffer .= $indent . '        data-fontcolor="';
                $value = $this->resolveValue($context->find('iconcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" style="background:';
                $value = $this->resolveValue($context->find('iconbackcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ';">
';
                $buffer .= $indent . '            <i class="';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" style="color:';
                $value = $this->resolveValue($context->find('iconcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"></i>
';
                $buffer .= $indent . '        </button>
';
                $buffer .= $indent . '        <p>';
                $value = $this->resolveValue($context->find('focushovername'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ' </p>
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
