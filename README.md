# openshift-php

**How to use this script**

*  Open `exec` function on php
*  Call index.php url by set values as GET format
*  Used commands is (test username is voltan) :
   *  `oc create user voltan` - Create user
   *  `oc create identity ldap_provider:voltan` - Create identity
   *  `oc create useridentitymapping ldap_provider:voltan voltan` - Add user to identity
   *  `oc create serviceaccount voltan` - Create service account
   *  `oc policy add-role-to-user admin system:serviceaccounts:test:voltan` - Add role to service account
   *  `oc serviceaccounts get-token voltan` - Get service account token
   
   
===

Webservice urls : 

*  `index.php?action=create&username=<USERNAME>` - Create user and identity and set user to identity
*  `index.php?action=serviceaccount&username=<USERNAME>` - Create service account
*  `index.php?action=role&username=<USERNAME>&role=<ROLE>&service=<SERVICE>` - Add role to service account
*  `index.php?action=token&username=<USERNAME>` - Get service account token
