/*  dvdisaster: Additional error correction for optical media.
 *  Copyright (C) 2004-2017 Carsten Gnoerlich.
 *
 *  Email: carsten@dvdisaster.org  -or-  cgnoerlich@fsfe.org
 *  Project homepage: http://www.dvdisaster.org
 *
 *  This file is part of dvdisaster.
 *
 *  dvdisaster is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  dvdisaster is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with dvdisaster. If not, see <http://www.gnu.org/licenses/>.
 */

#include "dvdisaster.h"

#include "rs01-includes.h"

/***
 *** Method registration
 ***/

static void destroy(Method*);

void register_rs01(void)
{  Method *method = g_malloc0(sizeof(Method));

   method->ckSumClosure = g_malloc0(sizeof(RS01CksumClosure));

   /*** Standard infomation and methods */ 

   strncpy(method->name, "RS01", 4);
   method->menuEntry = g_strdup(_("Error correction file (RS01)"));
   method->description = g_strdup(_("Classic Reed-Solomon method based on polynomial arithmetic"));
   method->create  = RS01Create;
   method->fix     = RS01Fix;
   method->verify  = RS01Verify;

   /*** Linkage to rs01-common.c */

   method->recognizeEccFile  = RS01Recognize;
   method->getCrcBuf         = RS01GetCrcBuf;
   method->resetCksums       = RS01ResetCksums;
   method->updateCksums      = RS01UpdateCksums;
   method->finalizeCksums    = RS01FinalizeCksums;
   method->expectedImageSize = RS01ExpectedImageSize;

#ifndef CLI
   /*** Linkage to rs01-window.c */

   method->createCreateWindow = CreateRS01EWindow;
   method->createFixWindow    = CreateRS01FWindow;

   method->resetCreateWindow = ResetRS01EncodeWindow;
   method->resetFixWindow    = ResetRS01FixWindow;

   method->createPrefsPage   = CreateRS01PrefsPage;
   method->resetPrefsPage    = ResetRS01PrefsPage;

   /*** Linkage to rs01-verify.c */

   method->createVerifyWindow = CreateRS01VerifyWindow;
   method->resetVerifyWindow  = ResetRS01VerifyWindow;
#endif

   /*** Register ourself */

   method->destroy = destroy;

   RegisterMethod(method);
}

static void destroy(Method *method)
{
#ifndef CLI
   RS01Widgets *wl = (RS01Widgets*)method->widgetList;
#endif

   g_free(method->ckSumClosure);

#ifndef CLI
   if(wl)
   {  if(wl->fixCurve) FreeCurve(wl->fixCurve);

      if(wl->cmpSpiral)
	FreeSpiral(wl->cmpSpiral);

      if(wl->cmpLayout)
	g_object_unref(wl->cmpLayout);

      g_free(wl);
   }
#endif
}


