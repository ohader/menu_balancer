===============================================================================
Extension menu_balancer
===============================================================================

How to use in TypoScript:

* you need to include the static TypoScript of this extension
* you need to define a postUserFunc in your top menu object (e.g. HMENU)

===============================================================================
Example
===============================================================================

10 = HMENU
10 {
	1 = TMENU
	2 = TMENU
	...

	wrap = <ul>|</ul>

	// Modifiy the output by this extension:
	stdWrap.postUserFunc < lib.tx_menubalancer.userFunc
	stdWrap.postUserFunc {
		// width/size - balance on how many columns?
		size = 2

		// processing to find the elements
		sizePattern = #<li[^>]*>#m
		splitPattern = #(<li[^>]*>|</li>)#m
		splitStart = <li
		splitEnd = </li>

		// remove the outer wrap (same as in [HMENU].wrap)
		unWrap = <ul>|</ul>

		// redo the wrapping (might be the same as in [HMENU].wrap)
		reWrap = <ul>|</ul>
	}
}

===============================================================================
  (c) 2011 Oliver Hader <oliver.hader@typo3.org> - licensed under the GPLv2+
===============================================================================
