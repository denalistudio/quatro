/**
 * Live Form Validation for Nette 2.0
 *
 * @author Radek Ježdík, MartyIX, David Grudl
 */
 
var LiveForm = {
        options: {
                controlErrorClass: 'form-control-error',            // CSS class for an invalid control
                errorMessageClass: 'form-error-message',            // CSS class for an error message
                validMessageClass: 'form-valid-message',            // CSS class for a valid message
                noLiveValidation: 'no-live-validation',             // CSS class for a valid message
                showValid: false,                                   // show message when valid
                dontShowWhenValidClass: 'dont-show-when-valid',     // control with this CSS class will not show valid message
                messageTag: 'span',                                 // tag that will hold the error/valid message
                messageIdPostfix: '_message',                       // message element id = control id + this postfix
                wait: 300                                           // delay in ms before validating on keyup/keydown
        },
 
        forms: { }
};
 
/**
 * Handlers for all the events that trigger validation
 * YOU CAN CHANGE these handlers (ie. to use jQuery events instead)
 */
LiveForm.setUpHandlers = function(el) {
        if (this.hasClass(el, this.options.noLiveValidation)) return;
 
        var handler = function(event) {
                event = event || window.event;
                Nette.validateControl(event.target ? event.target : event.srcElement);
        };
 
        var self = this;
 
        Nette.addEvent(el, "change", handler);
        Nette.addEvent(el, "blur", handler);
        Nette.addEvent(el, "keydown", function (event) {
                if (self.options.wait >= 200) {
                        // Hide validation span tag.
                        self.removeClass(this, self.options.controlErrorClass);
                        self.removeClass(this, self.options.validMessageClass);
                        
                        var error = self.getMessageElement(this);
                        error.innerHTML = '';
                        error.className = '';
                        
                        // Cancel timeout to run validation handler
                        if (self.timeout) {
                                clearTimeout(self.timeout);
                        }
                }
        });
        Nette.addEvent(el, "keyup", function (event) {
                event = event || window.event;
                if (event.keyCode !== 9) {
                        if (self.timeout) clearTimeout(self.timeout);
                                self.timeout = setTimeout(function() {
                                handler(event);
                        }, self.options.wait);
                }
        });
}
 
LiveForm.addError = function(el, message) {
        this.forms[el.form.id].hasError = true;
        this.addClass(el, this.options.controlErrorClass);
 
        if (!message) {
                message = '&nbsp;';
        }
 
        var error = this.getMessageElement(el);
        error.innerHTML = message;
}
 
LiveForm.removeError = function(el) {
        this.removeClass(el, this.options.controlErrorClass);
        var err_el = document.getElementById(el.id + this.options.messageIdPostfix);
 
        if (this.options.showValid && this.showValid(el)) {
                err_el = this.getMessageElement(el);
                err_el.className = this.options.validMessageClass;
                return;
        }
 
        if (err_el) {
                err_el.parentNode.removeChild(err_el);
        }
}
 
LiveForm.showValid = function(el) {
        if(el.type) {
                var type = el.type.toLowerCase();
                if(type == 'checkbox' || type == 'radio') {
                        return false;
                }
        }
        
        var rules = Nette.getRules(null, el);
        if(rules.length == 0) {
                return false;
        }
 
        if (this.hasClass(el, this.options.dontShowWhenValidClass)) {
                return false;
        }
 
        return true;
}
 
LiveForm.getMessageElement = function(el) {
        var id = el.id + this.options.messageIdPostfix;
        var error = document.getElementById(id);
 
        if (!error) {
                error = document.createElement(this.options.messageTag);
                error.id = id;
                el.parentNode.appendChild(error);
        }
 
        if (el.style.display == 'none') {
                error.style.display = 'none';
        }
 
        error.className = this.options.errorMessageClass;
        error.innerHTML = '';
        
        return error;
}
 
LiveForm.addClass = function(el, className) {
        if (!el.className) {
                el.className = className;
        } else if (!this.hasClass(el, className)) {
                el.className += ' ' + className;
        }
}
 
LiveForm.hasClass = function(el, className) {
        if (el.className)
                return el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
        return false;
}
 
LiveForm.removeClass = function(el, className) {
        if (this.hasClass(el, className)) {
                var reg = new RegExp('(\\s|^)'+ className + '(\\s|$)');
                var m = el.className.match(reg);
                el.className = el.className.replace(reg, (m[1] == ' ' && m[2] == ' ') ? ' ' : '');
        }
}
 
///////////////////////////////////////////////////////////////////////////////////////////
 
var Nette = Nette || { };
 
Nette.addEvent = function (element, on, callback) {
        var original = element['on' + on];
        element['on' + on] = function () {
                if (typeof original === 'function' && original.apply(element, arguments) === false) {
                        return false;
                }
                return callback.apply(element, arguments);
        };
};
 
 
Nette.getValue = function(elem) {
        var i, len;
        if (!elem) {
                return null;
 
        } else if (!elem.nodeName) { // radio
                for (i = 0, len = elem.length; i < len; i++) {
                        if (elem[i].checked) {
                                return elem[i].value;
                        }
                }
                return null;
 
        } else if (elem.nodeName.toLowerCase() === 'select') {
                var index = elem.selectedIndex, options = elem.options;
 
                if (index < 0) {
                        return null;
 
                } else if (elem.type === 'select-one') {
                        return options[index].value;
                }
 
                for (i = 0, values = [], len = options.length; i < len; i++) {
                        if (options[i].selected) {
                                values.push(options[i].value);
                        }
                }
                return values;
 
        } else if (elem.type === 'checkbox') {
                return elem.checked;
 
        } else if (elem.type === 'radio') {
                return Nette.getValue(elem.form.elements[elem.name].nodeName ? [elem] : elem.form.elements[elem.name]);
 
        } else {
                return elem.value.replace(/^\s+|\s+$/g, '');
        }
};
 
 
Nette.validateControl = function(elem, rules, onlyCheck) {
        rules = Nette.getRules(rules, elem);
        for (var id in rules) {
                var rule = rules[id][0] ? rules[id][0] : rules[id], op = rule.op.match(/(~)?([^?]+)/);
                rule.neg = op[1];
                rule.op = op[2];
                rule.condition = !!rule.rules;
                var el = rule.control ? elem.form.elements[rule.control] : elem;
 
                var success = Nette.validateRule(el, rule.op, rule.arg);
                if (success === null) continue;
                if (rule.neg) success = !success;
 
                if (rule.condition && success) {
                        if (!Nette.validateControl(elem, rule.rules, onlyCheck)) {
                                return false;
                        }
                } else if (!rule.condition && !success) {
                        if (el.disabled) continue;
                        if (!onlyCheck) {
                                Nette.addError(el, rule.msg.replace('%value', Nette.getValue(el)));
                        }
                        return false;
                }
        }
        if (!onlyCheck) {
                LiveForm.removeError(elem);
        }
        return true;
};
 
 
Nette.getRules = function(rules, elem) {
        return rules || eval('[' + (elem.getAttribute('d