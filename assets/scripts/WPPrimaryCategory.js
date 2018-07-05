// Create the WPPrimaryCategory module
const WPPrimaryCategory = (function() {

  let checkboxes;
  let primaryCategorySelect;

  const _updateSelect = function(evt) {
    evt.stopPropagation();
    const checkbox = evt.target;
    const categoryName = evt.target.parentElement.innerText.trim();
    const categoryId = checkbox.value;
    if(checkbox.checked) {
      _appendToSelect(categoryName, categoryId);
    } else {
      _removeFromSelect(categoryId);
    }
  };

  const _observeCategoryBox = function() {
    observeDOM( document.querySelector('#categorychecklist'), mutations => {
      const newNode = mutations[0].addedNodes[0];
      const newCategoryCheckbox = newNode.querySelector('input');
      const categoryId = newCategoryCheckbox.value;
      const categoryName = newNode.querySelector('label').innerText;

      newCategoryCheckbox.addEventListener('change', _updateSelect);
      _appendToSelect(categoryName, categoryId);
    });
  };

  const _appendToSelect = (categoryName, categoryId) => {
    const newOptionEl = document.createElement('option');
    newOptionEl.text = categoryName;
    newOptionEl.value = categoryId;
    primaryCategorySelect.appendChild(newOptionEl);
  };

  const _removeFromSelect = (categoryId) => {
    const oldOptionEl = document.querySelector(`#wp-primary-category-select option[value="${categoryId}"]`);
    primaryCategorySelect.removeChild(oldOptionEl);
  };

  const _getCheckboxes = () => {
    checkboxes = Array.from(document.querySelectorAll('#categorychecklist li, #categorychecklist-pop li'));
    checkboxes.map(checkbox => checkbox.addEventListener('change', _updateSelect));
  };

  const _getPrimaryCategorySelect = () => {
    primaryCategorySelect = document.querySelector('#wp-primary-category-select');
  };

  const init = () => {
    _getCheckboxes();
    _observeCategoryBox();
    _getPrimaryCategorySelect();
  };

  return {
    init
  };

})();
