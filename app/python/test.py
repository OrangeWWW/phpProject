from rdkit.Chem import Draw
from rdkit import Chem
import sys
smiles_temp = sys.argv[1]
sMis = [
    smiles_temp,
]
mOls = []
for smi in sMis:
    mol = Chem.MolFromSmiles(smi)
    mOls.append(mol)
img = Draw.MolsToGridImage(mOls, molsPerRow=1, subImgSize=(200, 200), legends=['' for x in mOls])
img.save('C:/phpStudy/PHPTutorial/WWW/herg_database/public/static/smiles_img/2D.jpg')